FROM node:lts-alpine as web-app
ENV NODE_ENV=production
# Move our files into directory name "app"
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .

EXPOSE 3000

CMD [ "node", "app.js" ] // start your backend
