# Build docker image for client.js
FROM node:16.16-slim

ENV NODE_ENV=production

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . ./

EXPOSE 3000

ENTRYPOINT ["node", "client.js"]
