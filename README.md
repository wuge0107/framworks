# FRAMWORKS

说明 因为框架采用了命名空间等方式、支持的php版本要大于5.5以上才可使用

使用比较简单

1、直接下载此框架到你的坏境目录下 地址 https://github.com/wuge0107/framworks.git    可以使用 git clone 进行拉取

2、访问方式是 根目录下的index.php为入口

3、此框架可以隐藏index.php .htaccess文件已经存在 不过你的apache要开启rewrite 重写 nginx也需要配置

4、路由方式 你的服务器地址 例如youserver出现了 welcome 默认访问的是Index控制器下的index方法

5、由于采用blade模版组件、会生成缓存文件、涉及到文件的读写。所以在linux系统下需要文件可读可写的权限(windows请忽略) 具体参考文档
