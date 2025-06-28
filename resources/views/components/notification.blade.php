
<div id="notification-container" class="notification-container">
    @if(session('success'))
        <div class="notification notification-success" id="notification-success">
            <div class="notification-content">
                <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="notification-message">{{ session('success') }}</span>
                <button class="notification-close" onclick="closeNotification('notification-success')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="notification-progress"></div>
        </div>
    @endif

    @if(session('error'))
        <div class="notification notification-error" id="notification-error">
            <div class="notification-content">
                <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="notification-message">{{ session('error') }}</span>
                <button class="notification-close" onclick="closeNotification('notification-error')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="notification-progress"></div>
        </div>
    @endif

    @if($errors->any())
        <div class="notification notification-error" id="notification-validation">
            <div class="notification-content">
                <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div class="notification-message">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                <button class="notification-close" onclick="closeNotification('notification-validation')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="notification-progress"></div>
        </div>
    @endif
</div>

<style>
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
}

.notification {
    background: white;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transform: translateX(100%);
    opacity: 0;
    animation: slideIn 0.3s ease-out forwards;
    position: relative;
}

.notification-success {
    border-left: 4px solid #10b981;
}

.notification-error {
    border-left: 4px solid #ef4444;
}

.notification-content {
    display: flex;
    align-items: flex-start;
    padding: 16px;
    gap: 12px;
}

.notification-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    margin-top: 2px;
}

.notification-success .notification-icon {
    color: #10b981;
}

.notification-error .notification-icon {
    color: #ef4444;
}

.notification-message {
    flex: 1;
    font-size: 14px;
    line-height: 1.4;
    color: #374151;
    font-weight: 500;
}

.notification-close {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    color: #9ca3af;
    transition: color 0.2s;
    flex-shrink: 0;
}

.notification-close:hover {
    color: #6b7280;
}

.notification-close svg {
    width: 18px;
    height: 18px;
}

.notification-progress {
    height: 3px;
    background: #f3f4f6;
    position: relative;
    overflow: hidden;
}

.notification-progress::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1));
    animation: progress 5s linear forwards;
}

.notification-success .notification-progress::after {
    background: #10b981;
}

.notification-error .notification-progress::after {
    background: #ef4444;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

@keyframes progress {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}

.notification-exit {
    animation: slideOut 0.3s ease-in forwards;
}

@media (max-width: 640px) {
    .notification-container {
        left: 20px;
        right: 20px;
        max-width: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide notifications after 5 seconds
    const notifications = document.querySelectorAll('.notification');
    
    notifications.forEach(function(notification) {
        const notificationId = notification.id;
        
        // Auto close after 5 seconds
        setTimeout(function() {
            closeNotification(notificationId);
        }, 5000);
    });
});

function closeNotification(notificationId) {
    const notification = document.getElementById(notificationId);
    if (notification) {
        notification.classList.add('notification-exit');
        setTimeout(function() {
            notification.remove();
        }, 300);
    }
}

// Function to show notification programmatically (for AJAX requests)
function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-container');
    const notificationId = 'notification-' + Date.now();
    
    const iconSvg = type === 'success' 
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
    
    const notificationHtml = `
        <div class="notification notification-${type}" id="${notificationId}">
            <div class="notification-content">
                <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${iconSvg}
                </svg>
                <span class="notification-message">${message}</span>
                <button class="notification-close" onclick="closeNotification('${notificationId}')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="notification-progress"></div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', notificationHtml);
    
    // Auto close after 5 seconds
    setTimeout(function() {
        closeNotification(notificationId);
    }, 5000);
}
</script>