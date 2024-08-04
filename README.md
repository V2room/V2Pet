# V2Pet

- [Frontend.md](Frontend.md)
- [Backend.md](Backend.md)

## 최초 설정

```shell
# composer install
# decrypt env
# update module
# run sail
# migration database
# npm install

composer post-init
```

## ENV 암호화

```shell
composer encrypt-env
```

## ENV 복호화

```shell
composer decrypt-env
```

## 최신 데이터 적용

module 과 database,env 등 변동이 있을 경우 실행시켜야 합니다

```shell
composer update-all
```

## Database 재설정

database migration, 데이터에 변동이 있을 경우 실행시켜야 합니다

```shell
# sail artisan migrate:fresh
# sail artisan migrate
# sail artisan db:seed

composer database-refresh
```

## How to start?

http://localhost 로 접속합니다

```shell
composer start
npm run dev
```

## How to Stop?

```shell
# 실행 중인 터미널 종료
ctrl + c

# sail stop
composer stop
```

## port address already in use 에러 발생시

```shell
# 3306 port 사용중인 프로세스 찾고 PID 확인
sudo lsof -i:3306

# pid 값으로 프로세스 종료
sudo kill <PID>
```
