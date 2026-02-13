server {
    server_name example.com;

    # root /var/www/foxford;
    # index index.html;

    access_log /var/log/nginx/example.com_access.log;
    error_log /var/log/nginx/example.com_error.log;

    location / {
        proxy_pass http://127.0.0.1:8899/;
        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

}