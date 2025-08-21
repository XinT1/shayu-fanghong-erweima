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
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            min-height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(76, 201, 240, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(247, 37, 133, 0.05) 0%, transparent 20%);
            z-index: -1;
        }
        
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.95);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 90;
            transition: opacity 0.5s ease;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(76, 201, 240, 0.2);
            border-top: 4px solid #4cc9f0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: #94a3b8;
            margin-top: 20px;
            font-size: 16px;
        }
        
        .progress-bar {
            width: 250px;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 15px;
        }
        
        .progress {
            height: 100%;
            background: linear-gradient(to right, #4361ee, #4cc9f0);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .status {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            color: #94a3b8;
            font-size: 14px;
        }
        
        .status.active {
            color: #4ade80;
        }
        
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loading">
        <div class="spinner"></div>
        <div class="loading-text">正在建立安全连接</div>
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <div class="status" id="connectionStatus">
            <i class="fas fa-shield-alt"></i> 
            <span>初始化安全协议...</span>
        </div>
    </div>
    
    <iframe id="secureFrame"></iframe>

    <!-- 使用Font Awesome图标 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const secureFrame = document.getElementById('secureFrame');
            const loadingElement = document.getElementById('loading');
            const progressElement = document.getElementById('progress');
            const connectionStatus = document.getElementById('connectionStatus');
            
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
            
            // 更新连接状态
            function updateStatus(text, icon = 'shield-alt') {
                connectionStatus.innerHTML = `<i class="fas fa-${icon}"></i> <span>${text}</span>`;
            }
            
            // 模拟进度条
            function simulateProgress() {
                let width = 0;
                const interval = setInterval(() => {
                    width += 2;
                    progressElement.style.width = width + '%';
                    
                    if (width >= 100) {
                        clearInterval(interval);
                    }
                }, 50);
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
                
                // 显示加载状态
                simulateProgress();
                
                // 更新状态
                setTimeout(() => {
                    updateStatus('验证访问者ID...', 'user-shield');
                }, 800);
                
                setTimeout(() => {
                    updateStatus('启用TLS加密通道...', 'lock');
                }, 1800);
                
                setTimeout(() => {
                    updateStatus('安全连接已建立', 'check-circle');
                    connectionStatus.classList.add('active');
                    
                    // 设置iframe源
                    secureFrame.src = fullUrl;
                    
                    // 隐藏加载状态
                    setTimeout(() => {
                        loadingElement.style.opacity = '0';
                        setTimeout(() => {
                            loadingElement.classList.add('hidden');
                        }, 500);
                    }, 1000);
                }, 3000);
            }
            
            // 启动初始化
            init();
        });
    </script>
</body>
</html>
