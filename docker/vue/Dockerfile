FROM node:18

WORKDIR /app

# Copie apenas os arquivos de dependência inicialmente
COPY package*.json ./

# Remover lockfile e reinstalar tudo corretamente
RUN rm -f package-lock.json && npm install

# Depois, copie o restante da aplicação
COPY . .

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host"]
