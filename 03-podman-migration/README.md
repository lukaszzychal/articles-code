## How to build your own image with Podman?

Podman uses the exact same syntax as Docker. You can use `Dockerfile` files, but the recommended OCI standard is the name `Containerfile`.

To build an image from the attached `Containerfile`, simply type in your terminal:

```bash
podman build --no-cache -t my-test-nginx -f Containerfile .

podman build --no-cache -t my-test-nginx -f Dockerfile .

podman run -d -p 8080:80 localhost/my-test-nginx

Go to http://localhost:8080 and see the result!

```
## How to run a docker-compose/compose with Podman?

```bash
podman compose up -d
podman compose -f compose.yaml up -d
```

## How to run a Pod with Podman?

```bash
podman kube play k8s-pod.yaml
```
