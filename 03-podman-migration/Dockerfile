# 📄 Dockerfile
# Standard image build file known from the Docker ecosystem
FROM docker.io/library/nginx:alpine

# Information labels
LABEL maintainer="Lukasz Zychal <lukasz.zychal.dev@gmail.com>"
LABEL description="Example image built from a Dockerfile"

# Copy our test page to the Nginx directory
COPY index.html /usr/share/nginx/html/index.html

# Expose port 80 (inside the container)
EXPOSE 80