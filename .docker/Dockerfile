# base image contains the dependencies and no application code
FROM viterbit/app-web-8.1:latest

COPY --chown=application --chmod=544 .docker/entrypoint.sh /etc/entrypoint.sh

# Switch to use a non-root user from here on
USER application
