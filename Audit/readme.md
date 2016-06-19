自动执行脚本
crontab -e
vim 写入 0 1 * * * /usr/bin/php -f /home/userxxx/update.php

cronjob的格式为：
MIN HOUR DOM MON DOW CMD
Field	Description	Allowed Value
MIN	Minute field	0 to 59
HOUR	Hour field	0 to 23
DOM	Day of Month	1-31
MON	Month field	1-12
DOW	Day Of Week	0-6（0表示星期天）
CMD	Command	Any command to be executed.