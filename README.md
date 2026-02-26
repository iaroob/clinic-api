# API de Gestión de Clínica

Esta es una API simple para gestionar una clínica. Proporciona autenticación del recepcionista, gestión de pacientes y creación de citas.

Se ha realizado el proyecto en Docker.

---

## Instalación

1. Clonar el repositorio:


git clone https://github.com/iaroob/clinica-api.git
cd clinica-api

2. Instalar dependencias:

   composer install

3. Configurar .env con tu base de datos:

   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=clinic
   DB_USERNAME=clinic
   DB_PASSWORD=clinic

4. Migrar base de datos:

   php artisan migrate

5. Iniciar servidor de desarrollo:

   php artisan serve

#Pruebas en Postman   

##Autenticación
###Login

Endpoint: POST /api/login

Descripción: Autentica un usuario y devuelve un token de acceso.

Ejemplo de payload:

{
    "email": "recepcionista@pruebas.com",
    "password": "tu_contraseña"
}

Ejemplo de Respuesta exitosa:

{
    "message": "Login exitoso",
    "user": {
        "id": 1,
        "name": "Recepcionista",
        "email": "recepcionista@pruebas.com"
    },
    "token": "TU_TOKEN_DE_API"
}

Nota: Usa este token en los siguientes endpoints en la cabecera Authorization: Bearer TU_TOKEN_DE_API.

##Pacientes
###Crear paciente

Endpoint: POST /api/patients

Cabecera: Authorization: Bearer TU_TOKEN_DE_API

Payload de ejemplo:

{
    "first_name": "Laura",
    "last_name": "Martínez",
    "email": "laura2@example.com",
    "phone": "600123456",
    "note": "Paciente con brackets"
}

Respuesta exitosa:

{
    "message": "Paciente creado correctamente",
    "patient": {
        "id": 3,
        "first_name": "Laura",
        "last_name": "Martínez",
        "email": "laura2@example.com",
        "phone": "600123456",
        "note": "Paciente con brackets",
        "created_at": "2026-02-26T17:52:58.000000Z",
        "updated_at": "2026-02-26T17:52:58.000000Z"
    }
}


##Citas
###Crear cita

Endpoint: POST /api/appointments

Cabecera: Authorization: Bearer TU_TOKEN_DE_API

Payload de ejemplo:

{
    "patient_id": 3,
    "dentist_id": 1,
    "fecha": "2026-02-27",
    "hora": "10:00",
    "duracion": 45,
    "motivo": "Revisión ortodoncia"
}

Respuesta exitosa:

{
    "message": "Cita creada correctamente",
    "appointment_id": 5
}
