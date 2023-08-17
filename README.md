# Laravel 10

## Instalando PEST

### Modulo Books

https://www.youtube.com/watch?v=a23XxEgWOtU&list=PLfdtiltiRHWGJNse_fSSIXkY60ZWJWsrE

- Se instala pest _composer require pestphp/pest --dev --with-all-dependencies_
- Se crea nueva carpeta _tests_ y la antigua se ignora
- Se crea un componente para los libros _Book_
- Se valida la ruta para registrar usuarios y el formulario. Se actualiza el archivo
- Se valida la ruta para el login de usuarios y el formulario
- Se conocen las functions() y expects() del archivo _pest_
- Se aplican rutas y test para crear libros y errores
- Se crea formulario y la vista de los libros
- Se valida que los libros creados existan en _BookIndexTest_ y _BookWithDatasetsTest_
- Se crea la funcion _expectGuest_
- Se valida la vista de edicion _BookEditTest_
- Se valida la edicion de un libro _BookUpdateTest_
- Se crea un _AuthBookServiceProvider_ y una politica _BookPolicy_ para los libros
- Se crea los requests _BookStoreRequest_ y _BookUpdateRequest_ para los libros
- Se crea el test unitario _FriendTest_ (Se agrega _can remove a friend_)
- Se genera el archivo para validar rutas _FriendRouteTest_
- Se genera el archivo para validar el indice de amigos _FriendIndexTest_
- Se genera el archivo para validar agregar amigos _FriendAddTest_
- Temporal commit

## Aplicando PEST

- Preparando entorno para pest
