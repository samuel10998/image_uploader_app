Kubernetes zakladne objekty:
Pod - najmensia jednotka
Serivce - vytvorenie intranetoveho spojenia s danym boodm (vsetko su to yaml)
Deployment - deklarativne nasadenie replikovanych podov
ReplicaSet - stary objekt na replikaciu Podov (deploy ho vyuziva)
Namespace - oddelenie zdrojov (dobre oddelovat projekty do namespacov)
ConfigMap - konfiguracie pre jednotlive aplikacne pody (je to akykolvek konfig. subor)
Secret - sifrovane udaje pre aplikaciu alebo cluster (ak chceme ulozit infor. ako api kluce, hesla, ... davame to sem)

# Uploader App

## Funkcia
Jednoduchý web, kde používateľ môže nahrať obrázok do adresára `/uploads`.

Prikazy ako sme isli:
1. docker build -t php-uploader:latest . buildnovanie appky / containeru
2. kubectl get ns - zistenie vsetkych namespace
3. kubectl apply -f k8s/ - aplikuje vsetky tie subory co su v k8s priecinku

4. kubectl get all -n exam-samuel  ??? overenie zisti este

Zistenie co sa nachadza v lokalnom priecinku /uploads co sme si vytvorili
1. kubectl exec -it -n exam-samuel $(kubectl get pod -n exam-samuel -l app=uploader -o jsonpath="{.items[0].metadata.name}") -- ls /uploads 

## Nasadenie
```bash
kubectl apply -f namespace.yaml
kubectl apply -f configmap.yaml
kubectl apply -f pv.yaml
kubectl apply -f pvc.yaml
kubectl apply -f deployment.yaml
kubectl apply -f service.yaml
