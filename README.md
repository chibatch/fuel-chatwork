# ChatWork package for FuelPHP

ChatWorkのAPIを操作するためのパッケージです。

## 基本のクラス
事前にAPIトークンを入手してください。

### APIクラス
APIクラスだけでもAPIの操作が可能です。

### ChatWorkクラス
このクラスから大体のことが始まります。

## 使い方
事前にAPIトークンを入手してください。

```
$chatwork = new ChatWork\ChatWork(array(
	'token' => YOUR_API_TOKEN,
));
```

### ログインユーザーの情報を取得
ログインしているユーザーの情報を取得します。

```
$user = $chatwork->get_current_user();

$rooms    = $user->get_rooms();
$status   = $user->get_status();
$tasks    = $user->get_tasks();
$contacts = $user->get_contacts();
```

### チャットを作成
新規にグループチャットを作成します。

```
$room = $chatwork->create_room($params);
```

### チャットを操作
チャットが持つ情報を取得します。

```
$messages = $room->get_messages();
$members  = $room->get_members();
$tasks    = $room->get_tasks();
$files    = $room->get_files();
```

### メッセージを送信
チャットにメッセージを送信します。

```
$room->send_message('HOGE');
```

### タスクを追加
チャットのメンバーにタスクを追加します。

```
$room->add_task('HOGE TASK', $params);
```
