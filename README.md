LeBot
===============

## 说明

本项目基于


[ThinkPHP 8.0](https://www.thinkphp.cn/)

[机器人开放平台API](https://bot.q.qq.com/wiki/develop/api/)

目前只有群聊和消息列表(私聊)，后续也不会考虑搞频道(我没有频道权限！！！)

## 环境

* PHP 8.0
* MYSQL 5.6
* sodium 拓展
* SSL

## 配置

伪静态

    location ~* (runtime|application)/{
	 return 403;
    }
    location / {
     if (!-e $request_filename){
      rewrite  ^(.*)$  /index.php?s=$1  last;   break;
     }
    }
运行目录

    public
## 在线体验
扫描二维码添加到 群和消息列表

![添加到 群和消息列表](https://doc.xiaole.work/img/lebot.png)

## 用户交流

点击加入

[QQ群](https://qm.qq.com/q/8GusJeq7ra)

[DODO](https://imdodo.com/s/126361)

## 联系作者

点击发起临时会话

[樂](https://res.abeim.cn/api-qq.chat?qq=3057054240)

## 致谢

感谢那些曾经帮助过我的人
