how to Run : 

- Install Minikube
- run command berikut : eval $(minikube docker-env)
- kemudian build image untuk web : docker build -t resto-web:v5 .
  Noted: Version bisa di sesuaikan dan juga di update di deployment.yaml
- update image di deployment.yaml (manifest/web/deployment.yaml) 
- kemudian pada folder manifest jalankan command : kubectl apply -k .
