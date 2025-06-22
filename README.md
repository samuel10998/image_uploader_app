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
1: docker build -t php-uploader:latest . buildnovanie appky / containeru
2: kubectl get ns - zistenie vsetkych namespace
3: kubectl apply -f k8s/ - aplikuje vsetky tie subory co su v k8s priecinku

kubectl get all -n exam-samuel  ??? overenie zisti este

Zistenie co sa nachadza v lokalnom priecinku /uploads co sme si vytvorili
kubectl exec -it -n exam-samuel $(kubectl get pod -n exam-samuel -l app=uploader -o jsonpath="{.items[0].metadata.name}") -- ls /uploads 

Bonusova uloha prikazy a postup: (Použitie Secret namiesto ConfigMap + Výpis nahratých obrázkov)
1. updatovali sme index.php aby to zobrazovalo obrazky na frontende.
2. updateli sme deployment.yaml + secret.yaml tak aby sme miesto configmap pouzivali secret.yaml
3. Pouzili sme tieto prikazy:
4. docker build -t php-uploader:latest .  tento prikaz sme buildli znova image v priecinku /app
5. kubectl delete pod -n exam-samuel -l app=uploader   - restartovali sme cely pod
6. kubectl apply -f k8s/ (Nie povinne) môzeme aplikovat nanovo pre istotu vsetky subory v k8s priecinku)
7. kubectl delete configmap upload-config -n exam-samuel  (nie povinne vymazali sme configmap)

BONUS #3 – Nahrať image na Docker Hub
1. docker login
2. docker tag php-uploader samuelg/php-uploader:1.0  //tagni image
3. docker push samuelg/php-uploader:1.0 //pushni image
4. Úprava v deployment.yaml:
//image: samuelg/php-uploader:1.0
//imagePullPolicy: IfNotPresent
//Nezabudni zmazať imagePullPolicy: Never, ak si ho tam mal.

## Nasadenie
```bash
kubectl apply -f namespace.yaml
kubectl apply -f configmap.yaml
kubectl apply -f pv.yaml
kubectl apply -f pvc.yaml
kubectl apply -f deployment.yaml
kubectl apply -f service.yaml




