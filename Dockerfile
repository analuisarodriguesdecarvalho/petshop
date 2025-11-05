FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy the current directory contents into the container's /var/www/html
COPY . /var/www/html

# Change the working directory to /var/www/html
WORKDIR /var/www/html

# Expose port 8000
EXPOSE 8000

# Command to run the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:8000"]
