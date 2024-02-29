![Roboplan company](https://img.interempresas.net/fotos/3353727.jpeg)

# Gestão de Frota

Gestão de Frota is a fleet management app developed by Douglas Lobo as his Professional Aptitude Project (PAP) for school. It was created for Robolan, a company where he is interning.

## About the Project

The main objective of this project is to provide a comprehensive solution for managing a fleet of vehicles, allowing for tracking maintenance, usage records, vehicle allocation, among other essential functionalities. Leveraging modern technologies such as Vue.js 3, Laravel 10, Inertia, and Vite, combined with the efficiency of Docker (Laravel Sail).

## Features

- Live calendar for vehicle allocation requesting and managemnt
- Mileage logging
- Fuel level monitoring
- Maintenance tracking and scheduling
- Issue reporting

## Usage

Gestão de Frota is intended for use by Robolan and its fleet of service vehicles. It provides visibility and oversight of the company's assets to improve efficiency.

## Development

Gestão de Frota utilizes technologies like Vue.js 3, Laravel 10, Inertia, and Vite, and tools like Docker and DBeaver for its development. Future enhancements may include driver scoring, accident reporting, and inventory management.


### Technologies Used

- Vue.js 3: A progressive framework for building user interfaces.
- Laravel 10: A PHP framework for web application development.
- Inertia: A library that enables building single-page applications (SPAs) without the need for REST APIs.
- Vite: A next-generation build tool for modern web projects.
- Docker (Laravel Sail): Facilitates setting up and running the development environment.
- DBeaver: Database management tool used during development.

## Setting Up the Development Environment

To set up the development environment and run the project locally, follow the steps below:

1. Clone this repository to your development environment:
   
```bash
git clone https://github.com/m0tay/gestao-de-frota.git
```

2. Install frontend and backend dependencies:
   
```bash
cd fleet-management
npm install
composer install
```

3. Copy the example .env.example file and rename it to .env. Configure the environment variables as needed.

4. Start the development environment using Docker (Laravel Sail):

```bash
./vendor/bin/sail up -d
```

5. Run database migrations and seeders:
```bash
./vendor/bin/sail artisan migrate --seed
```

## Contributing
If you'd like to contribute improvements or fixes to the project, feel free to submit pull requests. Before submitting a pull request, make sure to follow the contribution guidelines and ensure local tests have been successfully executed.

## License
This project is licensed under the MIT License.
