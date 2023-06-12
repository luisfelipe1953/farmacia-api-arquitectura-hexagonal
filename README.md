# Farmacia API - Arquitectura Hexagonal

Este repositorio contiene una API de ejemplo para un sistema de gestión de farmacias, implementada siguiendo la arquitectura hexagonal (también conocida como arquitectura de puertos y adaptadores).

La arquitectura hexagonal es un enfoque de diseño de software que promueve la separación de preocupaciones y la modularidad, facilitando la escalabilidad y el mantenimiento de la aplicación.

## Características

- **Capas bien definidas:** La aplicación está dividida en capas claras y separadas, incluyendo la capa de dominio, la capa de aplicación y la capa de infraestructura.
- **Independencia de frameworks y tecnologías:** La arquitectura hexagonal permite que la lógica de negocio esté aislada de los detalles de implementación y las dependencias externas.
- **Testabilidad y mantenibilidad:** La separación de preocupaciones facilita las pruebas unitarias y el mantenimiento de la aplicación.
- **Escalabilidad y flexibilidad:** La arquitectura hexagonal permite agregar o cambiar adaptadores (por ejemplo, una base de datos diferente) sin afectar la lógica de negocio.

## Estructura del proyecto

El repositorio sigue una estructura típica para un proyecto basado en la arquitectura hexagonal:

- **src**: Contiene el código fuente de la aplicación.
  - **Domain**: Define las entidades, los repositorios y los casos de uso del dominio.
  - **Application**: Implementa los casos de uso y orquesta la lógica de negocio.
  - **Infrastructure**: Contiene los adaptadores y las implementaciones concretas, como los repositorios de base de datos y las conexiones externas.
- **tests**: Incluye las pruebas unitarias y de integración para garantizar el correcto funcionamiento de la aplicación.
- **docs**: Documentación adicional, como diagramas de arquitectura, instrucciones de instalación, etc.

## Instalacion, configuracion y uso

- **Instalacion**

```sh
composer install
```

- **Configura tu archivo de variables de entorno (.env)**

- **Ejecuta las migraciones con datos falsos**

```sh
php artisan migrate --seed
```

- **Correr el servidor**

```sh
php artisan serve
```

- **Tambien puedes correr los Tests Unitarios incluidos**

```sh
php artisan test
```

# Consume la API con su Front Correspondiente
### [Repositorio Frontend con VueJS](https://github.com/luisfelipe1953/Pharmacer-front "Repositorio Frontend con VueJS")