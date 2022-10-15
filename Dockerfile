FROM node:lts-alpine as web-app
ENV NODE_ENV=production
# Move our files into directory name "app"
WORKDIR /app
COPY client/package.json /app/
RUN cd /app && npm install
COPY client/. /app
RUN cd /app && npm run build  // build your front end

EXPOSE 3000

CMD [ "node", "app.js" ] // start your backend