# Service Layer Pattern Implementation in PHP

This project illustrates the difference between "Fat Controller" (anti-pattern) and a clean architecture using the **Service Layer**.

### Structure

- **laravel/**:
    - `FatUserController`: An example of a bad approach (everything in the controller).
    - `CleanUserController` + `UserRegistrationService`: An example of a good approach with a service and `FormRequest` validation.

- **symfony/**:
    - A modern approach example (Symfony 6.3+ / PHP 8.2+).
    - `UserRegistrationDTO`: Data Transfer Object with built-in validation (attributes).
    - `MapRequestPayload`: Automatic mapping of HTTP request data to a DTO object.
    - `UserRegistrationService`: Business logic and database interaction (Doctrine).

### Why use the Service Layer?

1. **Reusability**: The same service can be called from a controller, console (CLI), or background job.
2. **Testability**: Services are easier to unit test without the need to simulate full HTTP requests.
3. **Single Responsibility Principle (SRP)**: The controller handles only HTTP (input/output), while the service handles business logic.

---

### Author

📖 Read my articles: [Follow me on Medium](https://medium.com/@lukaszzychal)

💼 Let's talk: [Connect with me on LinkedIn](https://www.linkedin.com/in/lukaszzychal)

**Lukasz Zychal** <lukasz.zychal.dev@gmail.com>


