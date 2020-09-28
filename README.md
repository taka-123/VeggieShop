## VeggieShopへ

http://118.27.17.227/veggieshop/index.php



## 確認

* ドキュメントルート: http://localhost:8080
* phpmyadmin: http://localhost:8888

## 開発環境

* php7.2
* mysql5.7
* phpmyadmin

### ログイン情報

管理者としてログイン

* id: admin
* pass: admin

一般ユーザーとしてログイン

* id: sampleuser
* pass: password

### dockerの起動・停止

~/MyDocker/lamp_practice/lamp_dock ディレクトリに移動し、

``` 
docker-compose up -d
```
でコンテナを起動

```
docker-compose down
```
で停止、コンテナ削除


```
docker exec -it lamp_dock_php_1 bash
```
でコンテナ内をbashで操作
