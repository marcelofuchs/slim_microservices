FROM node:9-alpine

RUN apk add --update \
    python \
    python-dev \
    py-pip \
    build-base \ 
  && apk --no-cache add make bash g++ zlib-dev libpng-dev \
  && pip install virtualenv \
  && rm -rf /var/cache/apk/*

RUN npm i -g npm

#RUN yun install libpng-dev
RUN npm install node-sass