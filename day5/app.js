// ============================================================================
// Mock Data
// ============================================================================

const mockUsers = [
    {
        id: '1',
        name: 'Alice Johnson',
        email: 'alice@example.com',
        avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Alice'
    },
    {
        id: '2',
        name: 'Bob Smith',
        email: 'bob@example.com',
        avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Bob'
    },
    {
        id: '3',
        name: 'Carol Davis',
        email: 'carol@example.com',
        avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Carol'
    },
    {
        id: '4',
        name: 'David Wilson',
        email: 'david@example.com',
        avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=David'
    },
    {
        id: '5',
        name: 'Eve Martinez',
        email: 'eve@example.com',
        avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Eve'
    }
];

let tickets = [
    {
        id: '1',
        name: 'Login page not loading',
        summary: 'Users reporting login page taking too long to load on mobile',
        status: 'in-progress',
        createdAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString(),
        assignedUsers: [mockUsers[0]],
        messageCount: 8
    },
    {
        id: '2',
        name: 'Database connection timeout',
        summary: 'App crashes when database connection times out',
        status: 'open',
        createdAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString(),
        assignedUsers: [mockUsers[1], mockUsers[2]],
        messageCount: 5
    },
    {
        id: '3',
        name: 'Export feature broken',
        summary: 'Users cannot export their data to CSV format',
        status: 'open',
        createdAt: new Date(Date.now() - 6 * 60 * 60 * 1000).toISOString(),
        assignedUsers: [mockUsers[3]],
        messageCount: 3
    },
    {
        id: '4',
        name: 'UI performance issues',
        summary: 'Dashboard becomes sluggish with 10k+ records',
        status: 'closed',
        createdAt: new Date(Date.now() - 10 * 24 * 60 * 60 * 1000).toISOString(),
        assignedUsers: [mockUsers[4]],
        messageCount: 12
    }
];

const ticketMessages = {
    '1': [
        {
            id: 'm1',
            senderId: '1',
            senderName: 'Alice Johnson',
            senderAvatar: mockUsers[0].avatar,
            message: 'I\'ve started looking into the mobile loading issue',
            timestamp: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm2',
            senderId: '2',
            senderName: 'Bob Smith',
            senderAvatar: mockUsers[1].avatar,
            message: 'Have you checked the network waterfall? Might be a CSS/JS issue',
            timestamp: new Date(Date.now() - 1.8 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm3',
            senderId: '1',
            senderName: 'Alice Johnson',
            senderAvatar: mockUsers[0].avatar,
            message: 'Yes, the JavaScript bundle is 500KB. We need to optimize it.',
            timestamp: new Date(Date.now() - 1.5 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm4',
            senderId: '1',
            senderName: 'Alice Johnson',
            senderAvatar: mockUsers[0].avatar,
            message: 'Working on optimizing the bundle size',
            timestamp: new Date(Date.now() - 1 * 60 * 60 * 1000).toISOString()
        }
    ],
    '2': [
        {
            id: 'm5',
            senderId: '2',
            senderName: 'Bob Smith',
            senderAvatar: mockUsers[1].avatar,
            message: 'Connection timing out after 30 seconds',
            timestamp: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm6',
            senderId: '3',
            senderName: 'Carol Davis',
            senderAvatar: mockUsers[2].avatar,
            message: 'Let\'s check the database logs',
            timestamp: new Date(Date.now() - 20 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm7',
            senderId: '2',
            senderName: 'Bob Smith',
            senderAvatar: mockUsers[1].avatar,
            message: 'Need to review the connection pool settings',
            timestamp: new Date(Date.now() - 1 * 60 * 60 * 1000).toISOString()
        }
    ],
    '3': [
        {
            id: 'm8',
            senderId: '4',
            senderName: 'David Wilson',
            senderAvatar: mockUsers[3].avatar,
            message: 'CSV export not working in the latest build',
            timestamp: new Date(Date.now() - 6 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm9',
            senderId: '4',
            senderName: 'David Wilson',
            senderAvatar: mockUsers[3].avatar,
            message: 'Found the issue in the CSV serializer',
            timestamp: new Date(Date.now() - 1 * 60 * 60 * 1000).toISOString()
        }
    ],
    '4': [
        {
            id: 'm10',
            senderId: '5',
            senderName: 'Eve Martinez',
            senderAvatar: mockUsers[4].avatar,
            message: 'Dashboard is very slow with large datasets',
            timestamp: new Date(Date.now() - 10 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm11',
            senderId: '5',
            senderName: 'Eve Martinez',
            senderAvatar: mockUsers[4].avatar,
            message: 'Implemented virtual scrolling and memo optimization',
            timestamp: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000).toISOString()
        },
        {
            id: 'm12',
            senderId: '5',
            senderName: 'Eve Martinez',
            senderAvatar: mockUsers[4].avatar,
            message: 'Deployed virtualization fix to production',
            timestamp: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString()
        }
    ]
};

// ============================================================================
// State
// ============================================================================

let currentSelectedTicketId = null;
let selectedUserIds = [];

// ============================================================================
// DOM Elements
// ============================================================================

const app = document.getElementById('app');
const newTicketBtn = document.getElementById('newTicketBtn');
const ticketModal = document.getElementById('ticketModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const cancelBtn = document.getElementById('cancelBtn');
const ticketForm = document.getElementById('ticketForm');
const ticketList = document.getElementById('ticketList');
const ticketCount = document.getElementById('ticketCount');
const chatContent = document.getElementById('chatContent');
const usersList = document.getElementById('usersList');
const formError = document.getElementById('formError');
const notificationBar = document.getElementById('notification');

// ============================================================================
// Helper Functions
// ============================================================================

function getStatusSVG(status) {
    if (status === 'open') {
        return `<svg class="status-icon open" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
        </svg>`;
    } else if (status === 'in-progress') {
        return `<svg class="status-icon in-progress" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
        </svg>`;
    } else if (status === 'closed') {
        return `<svg class="status-icon closed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>`;
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    if (date.toDateString() === today.toDateString()) {
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    } else if (date.toDateString() === yesterday.toDateString()) {
        return 'Yesterday';
    } else {
        return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
    }
}

function showNotification(message, type = 'success') {
    notificationBar.textContent = message;
    notificationBar.className = `notification-bar ${type}`;
    
    setTimeout(() => {
        notificationBar.classList.add('hidden');
    }, 3000);
}

function hideNotification() {
    notificationBar.classList.add('hidden');
}

// ============================================================================
// Render Functions
// ============================================================================

function renderTicketList() {
    ticketList.innerHTML = '';
    
    if (tickets.length === 0) {
        ticketList.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-secondary);">No tickets found</div>';
        ticketCount.textContent = '0 total';
        return;
    }

    ticketCount.textContent = `${tickets.length} total`;

    tickets.forEach(ticket => {
        const ticketDiv = document.createElement('div');
        ticketDiv.className = `ticket-item ${currentSelectedTicketId === ticket.id ? 'active' : ''}`;
        ticketDiv.onclick = () => selectTicket(ticket.id);

        const avatarsHTML = ticket.assignedUsers.slice(0, 3).map(user => 
            `<div class="ticket-avatar" title="${user.name}">
                <img src="${user.avatar}" alt="${user.name}">
            </div>`
        ).join('');

        const avatarCountHTML = ticket.assignedUsers.length > 3 
            ? `<div class="avatar-count">+${ticket.assignedUsers.length - 3}</div>`
            : '';

        ticketDiv.innerHTML = `
            <div class="ticket-status">
                ${getStatusSVG(ticket.status)}
                <span>${ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}</span>
            </div>
            <h3 class="ticket-name">${escapeHtml(ticket.name)}</h3>
            <p class="ticket-summary">${escapeHtml(ticket.summary)}</p>
            <div class="ticket-meta">
                <div class="ticket-avatars">
                    ${avatarsHTML}
                    ${avatarCountHTML}
                </div>
                <div class="ticket-message-count">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>${ticket.messageCount}</span>
                </div>
            </div>
        `;

        ticketList.appendChild(ticketDiv);
    });
}

function renderChatContent(ticketId) {
    if (!ticketId) {
        chatContent.innerHTML = `
            <div class="empty-state">
                <svg class="empty-state-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <h3 class="empty-state-title">No ticket selected</h3>
                <p class="empty-state-text">Select a ticket from the list to view its details and chat history</p>
            </div>
        `;
        return;
    }

    const ticket = tickets.find(t => t.id === ticketId);
    if (!ticket) {
        chatContent.innerHTML = '<div class="empty-state"><p>Ticket not found</p></div>';
        return;
    }

    const messages = ticketMessages[ticketId] || [];

    const assignedUsersHTML = ticket.assignedUsers.length > 0
        ? ticket.assignedUsers.map(user =>
            `<div class="assigned-user" title="${user.name}">
                <img src="${user.avatar}" alt="${user.name}">
            </div>`
        ).join('')
        : '<p class="unassigned-text">Unassigned</p>';

    const messagesHTML = messages.length === 0
        ? '<div class="messages-empty">No messages yet. Start the conversation!</div>'
        : messages.map(msg => {
            const isOwn = msg.senderId === 'current-user';
            return `
                <div class="message ${isOwn ? 'own' : ''}">
                    ${!isOwn ? `
                        <div class="message-avatar">
                            <img src="${msg.senderAvatar}" alt="${msg.senderName}">
                        </div>
                    ` : ''}
                    <div class="message-content">
                        ${!isOwn ? `<div class="message-sender">${escapeHtml(msg.senderName)}</div>` : ''}
                        <div class="message-bubble">${escapeHtml(msg.message)}</div>
                        <div class="message-time">${formatDate(msg.timestamp)}</div>
                    </div>
                    ${isOwn ? `
                        <div class="message-avatar">
                            <div style="width: 100%; height: 100%; background-color: #3b82f6; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; border-radius: 50%;">Y</div>
                        </div>
                    ` : ''}
                </div>
            `;
        }).join('');

    chatContent.innerHTML = `
        <div class="chat-header">
            <div class="chat-header-top">
                <div>
                    <div class="chat-status-badge">
                        ${getStatusSVG(ticket.status)}
                        <span>${ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}</span>
                    </div>
                </div>
            </div>
            <h2 class="chat-title">${escapeHtml(ticket.name)}</h2>
            <p class="chat-description">${escapeHtml(ticket.summary)}</p>
            <div class="chat-meta">
                <div class="chat-meta-item">
                    <div class="chat-meta-label">Assigned To</div>
                    <div class="assigned-users">
                        ${assignedUsersHTML}
                    </div>
                </div>
                <div class="chat-meta-item">
                    <div class="chat-meta-label">Created</div>
                    <div class="chat-meta-value">${new Date(ticket.createdAt).toLocaleDateString()}</div>
                </div>
            </div>
        </div>
        <div class="messages-container">
            ${messagesHTML}
        </div>
        <div class="chat-input-container">
            <form class="chat-input-form" onsubmit="handleSendMessage(event, '${ticketId}')">
                <input 
                    type="text" 
                    class="chat-input" 
                    placeholder="Type your message..." 
                    id="messageInput"
                    autocomplete="off"
                >
                <button type="submit" class="btn btn-primary chat-send-btn">
                    <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
        </div>
    `;

    // Auto-scroll to bottom
    setTimeout(() => {
        const messagesContainer = document.querySelector('.messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 0);
}

function renderUsersList() {
    usersList.innerHTML = '';
    
    mockUsers.forEach(user => {
        const label = document.createElement('label');
        label.className = 'user-checkbox';
        
        const isSelected = selectedUserIds.includes(user.id);
        
        label.innerHTML = `
            <input 
                type="checkbox" 
                value="${user.id}" 
                ${isSelected ? 'checked' : ''}
            >
            <div class="user-avatar-small">
                <img src="${user.avatar}" alt="${user.name}">
            </div>
            <div class="user-info">
                <div class="user-name">${escapeHtml(user.name)}</div>
                <div class="user-email">${escapeHtml(user.email)}</div>
            </div>
        `;
        
        const checkbox = label.querySelector('input[type="checkbox"]');
        checkbox.addEventListener('change', (e) => {
            if (e.target.checked) {
                selectedUserIds.push(user.id);
            } else {
                selectedUserIds = selectedUserIds.filter(id => id !== user.id);
            }
        });
        
        usersList.appendChild(label);
    });
}

// ============================================================================
// Event Handlers
// ============================================================================

function selectTicket(ticketId) {
    currentSelectedTicketId = ticketId;
    renderTicketList();
    renderChatContent(ticketId);
}

function handleSendMessage(event, ticketId) {
    event.preventDefault();
    
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    const newMessage = {
        id: 'm' + Date.now(),
        senderId: 'current-user',
        senderName: 'You',
        message: message,
        timestamp: new Date().toISOString()
    };
    
    if (!ticketMessages[ticketId]) {
        ticketMessages[ticketId] = [];
    }
    
    ticketMessages[ticketId].push(newMessage);
    
    input.value = '';
    input.focus();
    
    renderChatContent(ticketId);
}

function openModal() {
    selectedUserIds = [];
    ticketForm.reset();
    formError.classList.add('hidden');
    renderUsersList();
    ticketModal.classList.remove('hidden');
}

function closeModal() {
    ticketModal.classList.add('hidden');
}

function handleCreateTicket(event) {
    event.preventDefault();
    formError.classList.add('hidden');
    
    const name = document.getElementById('ticketName').value.trim();
    const summary = document.getElementById('ticketSummary').value.trim();
    
    if (!name) {
        showError('Ticket name is required');
        return;
    }
    
    if (!summary) {
        showError('Summary is required');
        return;
    }
    
    const assignedUsers = mockUsers.filter(u => selectedUserIds.includes(u.id));
    
    const newTicket = {
        id: String(tickets.length + 1),
        name: name,
        summary: summary,
        status: 'open',
        createdAt: new Date().toISOString(),
        assignedUsers: assignedUsers,
        messageCount: 0
    };
    
    tickets.unshift(newTicket);
    ticketMessages[newTicket.id] = [];
    
    renderTicketList();
    selectTicket(newTicket.id);
    closeModal();
    showNotification('Ticket created successfully!', 'success');
}

function showError(message) {
    formError.textContent = message;
    formError.classList.remove('hidden');
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================================
// Event Listeners
// ============================================================================

newTicketBtn.addEventListener('click', openModal);
closeModalBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
ticketForm.addEventListener('submit', handleCreateTicket);

// Close modal when clicking overlay
ticketModal.addEventListener('click', (e) => {
    if (e.target === ticketModal || e.target === ticketModal.querySelector('.modal-overlay')) {
        closeModal();
    }
});

// ============================================================================
// Initialize App
// ============================================================================

function initApp() {
    renderTicketList();
    renderChatContent(null);
}

// Start the app when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
