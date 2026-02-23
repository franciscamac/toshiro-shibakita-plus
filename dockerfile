# Usa imagem Alpine: muito mais leve (~23MB vs ~142MB da imagem padrão)
FROM nginx:1.25-alpine

# Boa prática: remover o config padrão do nginx para evitar conflitos
RUN rm /etc/nginx/conf.d/default.conf

# Copia seu arquivo de configuração customizado
COPY nginx.conf /etc/nginx/nginx.conf

# Documenta que o container escuta na porta 4500 (igual ao nginx.conf)
EXPOSE 4500

# Roda o nginx em foreground (obrigatório para Docker)
CMD ["nginx", "-g", "daemon off;"]
