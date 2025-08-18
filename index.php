<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全链接</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        
        body {
            background: #0f172a;
            min-height: 100vh;
            overflow: hidden;
        }
        
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <iframe id="secureFrame"></iframe>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const secureFrame = document.getElementById('secureFrame');
            
            // 生成持久化访问者ID
            function generatePersistentVisiterId() {
                // 检查localStorage中是否已有ID
                let visiterId = localStorage.getItem('persistentVisiterId');
                
                // 如果没有则生成新ID
                if (!visiterId) {
                    const prefix = 'PID-';
                    const timestamp = Date.now().toString(36).toUpperCase();
                    const randomPart = Math.random().toString(36).substring(2, 10).toUpperCase();
                    visiterId = `${prefix}${timestamp}-${randomPart}`;
                    
                    // 存储ID到localStorage
                    localStorage.setItem('persistentVisiterId', visiterId);
                }
                
                return visiterId;
            }
            
            // 初始化页面
            function init() {
                // 获取持久化ID
                const visiterId = generatePersistentVisiterId();
                
                const baseUrl = 'http://kf.dafadianwan.top/index/index/home';
                const params = new URLSearchParams({
                    visiter_id: visiterId,
                    visiter_name: '',
                    avatar: '',
                    groupid: '0',
                    business_id: '1'
                });
                
                const fullUrl = `${baseUrl}?${params.toString()}`;
                
                // 设置iframe源
                secureFrame.src = fullUrl;
            }
            
            // 启动初始化
            init();
        });
    </script>
</body>
</html>
