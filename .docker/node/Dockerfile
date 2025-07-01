# Use uma imagem base oficial do Node.js
FROM node:20-alpine

# Define o diretório de trabalho dentro do container.
# Este é o diretório onde sua aplicação Vue.js será montada via volume.
WORKDIR /app

# Instala dependências globais, se necessário (ex: yarn)
# RUN npm install -g yarn

# Expõe a porta que a aplicação Node.js irá rodar.
# Esta porta deve corresponder à porta que o servidor de desenvolvimento do Vue.js usa.
EXPOSE 8080

# Comando padrão para manter o container Node.js em execução.
# Isso permite que você execute comandos manualmente dentro do container
# antes que o projeto Vue.js esteja totalmente configurado.
CMD ["tail", "-f", "/dev/null"]
