BASEDIR=${PWD}/$(dirname "$0")

echo "--------- CRIANDO NETWORK ----------"
sudo docker network create --subnet 172.30.0.0/16 camaleao_net

sudo docker rm -f camaleao.local
sudo docker rm -f camaleao.db

echo "--------- BUILDANDO A IMAGEM ----------"
sudo docker build -t camaleao_image ${BASEDIR}/Apache

echo "--------- CRIANDO CONTAINER ----------"
sudo docker run --name camaleao.local -idt --net camaleao_net --ip=172.30.0.2 -v ${BASEDIR}/..:/var/www/html camaleao_image
sudo docker run --name camaleao.db -idt --net camaleao_net --ip=172.30.0.3 -e POSTGRES_PASSWORD=toor -e PGDATA=/var/lib/postgresql/data/pgdata -v ${BASEDIR}/../../Databases/camaleao:/var/lib/postgresql/data postgres

echo "--------- CRIANDO HOSTS ----------"
if grep "172.30.0.2" /etc/hosts> /dev/null
then
    echo "--------- HOST JÁ EXISTE ----------"
    echo "--------- ATUALIZANDO PROJETO ----------"
    echo "LINK:  http://camaleao.local"
    exit
fi
echo "--------- HOST CRIADA ----------"
sudo echo "172.30.0.2 camaleao.local" | sudo tee -a /etc/hosts
echo "--------- ATUALIZANDO PROJETO ----------"
echo "LINK:  http://camaleao.local"
