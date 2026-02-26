<?php

namespace App\Legacy;

use PDO;
use App\Legacy\Database;

class AppointmentLegacy
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    /**
     * Crear una nueva cita
     *
     * @param array $data ['paciente_id', 'dentista_id', 'fecha', 'hora', 'duracion', 'motivo']
     * @return array
     */
    public function create(array $data): array
    {
        // Validar datos obligatorios
        if (empty($data['paciente_id']) || empty($data['dentista_id']) || empty($data['fecha']) || empty($data['hora'])) {
            return ['status' => 'error', 'message' => 'Datos incompletos'];
        }

        $inicio = $data['fecha'] . ' ' . $data['hora'];
        $duracion = $data['duracion'] ?? 30;
        $fin = date('Y-m-d H:i:s', strtotime($inicio) + ((int)$duracion * 60));

        // SQL actualizado a tu tabla "appointments" y columnas en inglés
        $sql = "INSERT INTO appointments (patient_id, dentist_id, start, end, reason)
                VALUES (:patient_id, :dentist_id, :start, :end, :reason)";

        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                ':patient_id' => $data['paciente_id'],
                ':dentist_id' => $data['dentista_id'],
                ':start' => $inicio,
                ':end' => $fin,
                ':reason' => $data['motivo'] ?? '',
            ]);

            return [
                'status' => 'success',
                'appointment_id' => $this->db->lastInsertId()
            ];
        } catch (\PDOException $e) {
            return [
                'status' => 'error',
                'message' => 'Error al crear cita: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Listar citas por fecha
     *
     * @param string $date YYYY-MM-DD
     * @return array
     */
    public function getByDate(string $date): array
    {
        $sql = "SELECT * FROM appointments WHERE DATE(start) = :date ORDER BY start ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':date' => $date]);
        return $stmt->fetchAll();
    }

    /**
     * Obtener una cita por su ID
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM appointments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}