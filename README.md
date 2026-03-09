# Moodle Docker

### Env description

- Nginx 1.28
- PHP 8.4
- MariaDB 10.11
- Redis 7

The environment satisfies moodle 5.1 requirements

---

## Migrate Moodle under Docker

### Step 1 - prepare environment
- clone this repository
- create env file: `cp .example-env .env
`
- create dirs and files: `mkdir -p data/db && mkdir data/db/root && mkdir data/db_dumps && mkdir -p data/docker/php/root
`
- build Docker images: `docker compose build php`
- `docker compose up -d` (check `docker compose up` first)

### Step 2 - prepare files
- copy moodle source code inside `moodle` directory
- modify `config.php` values (recheck all values such as db user and password, domain name, etc)
  - `$CFG->dbtype = 'mariadb';`
  - `$CFG->dbhost = 'db';`
- copy moodle code inside `moodle` directory
- copy moodle data inside `moodledata` directory
- copy DB dump into `data/db_dumps`

### Step 3 - prepare database
- check DB and user
```shell
docker compose exec db bash

mariadb -uroot -p"${MARIADB_ROOT_PASSWORD}"

SHOW GRANTS FOR 'moodle'@'%';
exit
```


### Step 4 - web server configuration
As we are running Docker environment, we should create host machine web server config
to proxy our domain requests inside Docker environment.

Create Nginx server config (see configs/nginx in this repo)
`vim /etc/nginx/sites-available/example.com`


### Step 5 - cron configuration

```shell
crontab -l
service cron status

touch /var/log/moodle_cron.log

# command to run/check manually
cd /home/vic/Projects/MOODLE/Foxford/docker_envs/foxford72rc && docker compose exec -T php php /var/www/moodle/admin/cli/cron.php >> /var/log/moodle_cron.log 2>&1

crontab -e
# cron expression
*/10 * * * * cd /home/vic/Projects/MOODLE/Foxford/docker_envs/foxford72rc && docker compose exec -T php php /var/www/moodle/admin/cli/cron.php >> /var/log/moodle_cron.log 2>&1
```

### Step 6 - mail server configuration

In case we are running our own Mail server in separate docker compose env 
we should connect it via external network
```shell
docker network create mail-bridge
```