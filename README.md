# Movie Ticket


## Description
Movie Ticket is a web application that allows users to book movie tickets online. It provides a convenient way for users to browse movies, view showtimes, watch trailer and reserve seats for their preferred movie screenings.

## Note
- This project is for educational purposes only.
- This project is not intended for commercial use.
- This project is not affiliated with CGV Cinemas.


## Features
- User authentication: Users can sign up for an account and log in to the website to book movie tickets.
- Search and filter movies: Users can search for movies by title, genre.
- Browse movies: Users can view a list of available movies and get detailed information about each movie, such as the title, genre, director, actors, trailer, and synopsis.
- View showtimes: Users can see the showtimes for each movie, including the date, time, and theater location.
- Reserve seats: Users can select their preferred movie screening and reserve seats by choosing the desired seats and providing their contact information.
- Email confirmation: Users will receive an email confirmation of their ticket reservation.
- Admin dashboard: Admins can log in to the admin dashboard to manage movies, theaters, showtimes, and statistics.

## Technologies
- Front-ent: HTML, CSS, JavaScript, Bootstrap, jQuery
- Back-end: PHP, MariaDB
- APIs: Email API
- Tools: Git, GitHub, Visual Studio Code
- Deployment: Apache2 web server
- Operating system: Ubuntu 22.04 LTS

## Installation
1. Clone the repository: ```git clone https://github.com/20002110/THUD.git ```
2. Install the Apache2 web server: ```sudo apt install apache2```
3. Install PHP: ```sudo apt install php libapache2-mod-php php-mysql```
4. Install MariaDB: ```sudo apt install mariadb-server```
5. Install phpMyAdmin: ```sudo apt install phpmyadmin```
6. Set up the database: import the database schema from the `sql` folder. ```mysql -u [your_account] -p < sql/movie_ticket.sql```
7. Configure Apache2: configure the Apache2 web server to serve the website from the `public` folder. ```sudo nano /etc/apache2/sites-available/000-default.conf```


## Usage
1. Open the website in your web browser at `https://danhnt.me/` or `http://localhost/`.
2. Browse the available movies and select a movie to view its showtimes.
3. Choose a showtime and select the desired seats.
4. Provide your contact information.
5. Receive a confirmation of your ticket reservation.

## Contributing
Contributions are welcome! If you would like to contribute to the Movie Ticket project, please follow these steps:
1. Fork the repository.
2. Create a new branch: ```git checkout -b feature/your-feature-name```
3. Make your changes and commit them: ```git commit -m 'Add your commit message'```
4. Push to the branch: ```git push origin feature/your-feature-name```
5. Submit a pull request.


## Team
- Nguyen Truong Danh
- KyoGren
- TL27
- Hunter1202

## License
Apache License 2.0 
Copyright CGV*

## Contact
- Corresponding author: danhnt1211@gmail.com -


