<?php require_once('header.php'); global $session_data,$permission;?>
	<style type="text/css">
		.table .thead-dark th {color: #fff; background-color: #00386a; border-color: #00386a; font-weight: bold; padding: 12px 5px;}
		.table th,.table td{font-size: 14px !important;}
		d{padding: 10px 5px !important;}
	</style>

	<div class="content">
    	<?php if($session_data['is_admin']==1):?>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10" style="margin-top: -20px;">
				<div class="card">
				    <!-- removed the card header title 'Messages' as requested -->
				    <div class="card-body">
				        <!-- Ticketing system inner UI inserted below (headings removed) -->
				        <div id="app" class="app-container" style="min-height:400px;">
				            <header class="app-header">
				                <div id="notification" class="notification-bar hidden"></div>

				            </header>

				            <main class="main-content">
				                <aside class="ticket-list-panel">
				                    <div class="panel-header">
				                        <div>
				                            <h2 class="panel-title">Tickets</h2>
				                            <p class="panel-count" id="ticketCount">0 total</p>
				                        </div>
				                        <!-- replaced New Ticket button with ticket filter -->
				                        <div class="panel-actions">
				                            <select id="ticketFilterSelect" class="form-input" style="min-width:160px; padding:6px 8px; border-radius:8px; font-size:13px;">
				                                <option value="all">All</option>
				                                <option value="open">Open</option>
				                                <option value="in_progress">In Progress</option>
				                                <option value="resolved">Resolved</option>
				                                <option value="closed">Closed</option>
				                            </select>
				                        </div>
				                    </div>
				                    <div class="panel-content">
				                        <div id="ticketList" class="ticket-list"></div>
				                    </div>
				                </aside>

				                <section class="ticket-chat-panel">
				                    <div id="chatContent" class="chat-content">
				                        <div class="empty-state">
				                            <svg class="empty-state-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
				                            </svg>
				                            <h3 class="empty-state-title">No ticket selected</h3>
				                            <p class="empty-state-text">Select a ticket from the list to view its details and chat history</p>
				                            <div style="margin-top:16px;">
				                                <button id="newTicketBtn" class="btn btn-primary btn-sm">+ New Ticket</button>
				                            </div>
				                        </div>
				                    </div>
				                </section>
				            </main>
				        </div>

				        <!-- Create Ticket Modal -->
				        <div id="ticketModal" class="modal hidden">
				            <div class="modal-overlay"></div>
				            <div class="modal-content">
				                <div class="modal-header">
				                    <h2 class="modal-title">Create New Ticket</h2>
				                    <button id="closeModalBtn" class="btn-close">
				                        <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				                            <line x1="18" y1="6" x2="6" y2="18"></line>
				                            <line x1="6" y1="6" x2="18" y2="18"></line>
				                        </svg>
				                    </button>
				                </div>

				                <form id="ticketForm" class="modal-form">
				                    <div class="form-group">
				                        <label for="ticketName" class="form-label">Ticket Name * <small style="font-weight:normal; color:var(--muted);">(max 75 chars)</small></label>
				                        <input type="text" id="ticketName" class="form-input" placeholder="e.g., Login page not loading" required maxlength="75" data-max-chars="75" aria-describedby="ticketNameHelp">
				                        <div id="ticketNameHelp" style="font-size:12px;color:var(--text-secondary);margin-top:4px;">0/75 chars</div>
				                    </div>

				                    <div class="form-group">
				                        <label for="ticketSummary" class="form-label">Summary *</label>
				                        <textarea id="ticketSummary" class="form-textarea" placeholder="Describe the issue or feature request..." rows="4" required></textarea>
				                    </div>

				                    <div class="form-group">
				                        <label class="form-label">Assign Users</label>
				                        <div id="usersList" class="users-list"></div>
				                    </div>

				                    <div id="formError" class="form-error hidden"></div>

				                    <div class="form-actions">
				                        <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
				                        <button type="submit" class="btn btn-primary">Create Ticket</button>
				                    </div>
				                </form>
				            </div>
				        </div>

				        <!-- Embedded styles from mydirectory/styles.css -->
				        <style>
				        /* ...existing code... */
:root {
    --primary: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #60a5fa;
    --primary-bg: #eff6ff;
    --secondary: #f3f4f6;
    --secondary-dark: #e5e7eb;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --muted: #6b7280;
    --muted-light: #9ca3af;
    --text-primary: #111827;
    --text-secondary: #6b7280;
    --border: #e5e7eb;
    --background: #ffffff;
    --background-alt: #f9fafb;
    --background-light: #f3f4f6;

    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;

    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

html, body {
    width: 100%;
    height: 100%;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    background-color: var(--background);
    color: var(--text-primary);
}

#app {
    width: 100%;
    height: 100%;
}

.app-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background-color: var(--background);
}

/* Header */
.app-header {
    background-color: var(--background);
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
}

.notification-bar {
    padding: 12px 24px;
    background-color: #dbeafe;
    border-bottom: 1px solid #93c5fd;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    color: #0c4a6e;
    animation: slideDown 0.3s ease-out;
}

.notification-bar.hidden {
    display: none;
}

.notification-bar.success {
    background-color: #dcfce7;
    border-bottom-color: #86efac;
    color: #166534;
}

.notification-bar.error {
    background-color: #fee2e2;
    border-bottom-color: #fca5a5;
    color: #991b1b;
}



.header-left {
    flex: 1;
}

.header-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.header-subtitle {
    font-size: 14px;
    color: var(--text-secondary);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 16px;
    border: none;
    border-radius: var(--radius-md);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    font-family: inherit;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    box-shadow: var(--shadow-md);
}

.btn-primary:active {
    background-color: #1d4ed8;
}

.btn-secondary {
    background-color: var(--background-light);
    color: var(--text-primary);
    border: 1px solid var(--border);
}

.btn-secondary:hover {
    background-color: var(--secondary-dark);
}

.btn-lg {
    padding: 10px 16px;
    font-size: 15px;
    font-weight: 600;
}

.btn-close {
    padding: 8px;
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-secondary);
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-close:hover {
    color: var(--text-primary);
    background-color: var(--background-light);
    border-radius: var(--radius-md);
}

.icon {
    display: inline-block;
    flex-shrink: 0;
}

/* Main Content */
.main-content {
    display: flex;
    flex: 1 1 auto;
    min-height: 0;
}

/* Panel Layout */
.ticket-list-panel {
    width: 320px;
    display: flex;
    flex-direction: column;
    min-height: 0; /* critical for overflow to work */
}

.ticket-chat-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: var(--background);
    overflow: hidden;
}

.panel-header {
    height: auto; /* let content determine height */
    border-radius:10px;
    padding: 8px 12px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.panel-title {
    font-size: 18px;
    font-weight: 600;
    color: white;
    margin-bottom: 2px;
}

.panel-count {
    font-size: 12px;
    color: white;
    margin-top: 4px;
}

.panel-content {
    flex: 1 1 auto;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 0;
    min-height: 0; /* allow it to shrink inside flex container */
}

/* Ticket List */
.ticket-list {
    display: flex;
    flex-direction: column;
}

.ticket-item {
    padding: 16px;
    border-bottom: 1px solid var(--border);
    cursor: pointer;
    transition: var(--transition);
    border-left: 3px solid transparent;
}

.ticket-item:hover {
    background-color: var(--background-light);
}

.ticket-item.active {
    background-color: var(--background-light);
    border-left-color: var(--primary);
}

.ticket-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: 8px;
}

.status-icon {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.status-icon.open {
    color: var(--danger);
}

.status-icon.in-progress {
    color: var(--warning);
}

.status-icon.closed {
    color: var(--success);
}

.ticket-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 6px;
    word-break: break-word;
}

.ticket-summary {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ticket-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.ticket-avatars {
    display: flex;
    gap: -8px;
}

.ticket-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 2px solid white;
    overflow: hidden;
    flex-shrink: 0;
    margin-right: -8px;
}

.ticket-avatar .avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    border-radius: 50%;
    text-transform: uppercase;
}

.ticket-avatar .avatar-initial {
    width: 24px;
    height: 24px;
    font-size: 12px;
}

.ticket-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ticket-avatar:last-child {
    margin-right: 0;
}

.avatar-count {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: var(--background-light);
    border: 2px solid white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
    color: var(--text-secondary);
}

.ticket-message-count {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: var(--text-secondary);
}

/* Empty State */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 40px 20px;
    text-align: center;
    background: linear-gradient(135deg, var(--background-light) 0%, var(--background) 100%);
}

.empty-state-icon {
    color: var(--primary);
    margin-bottom: 20px;
    opacity: 0.3;
}

.empty-state-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.empty-state-text {
    font-size: 14px;
    color: var(--text-secondary);
    max-width: 320px;
}

/* Chat Content */
.chat-content {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.chat-header {
    padding: 16px;
    border-bottom: 1px solid var(--border);
}

.chat-header-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: var(--text-secondary);
}

.chat-title {
    font-size: 20px;
    margin: 12px 0 4px 0;
}

.chat-description {
    color: var(--text-secondary);
    margin-bottom: 12px;
}

.chat-meta {
    display: flex;
    gap: 24px;
    align-items: center;
}

.chat-meta-item {
    display: flex;
    flex-direction: column;
}

.chat-meta-label {
    font-size: 12px;
    color: var(--text-secondary);
}

.assigned-users {
    display: flex;
    gap: 8px;
    align-items: center;
}

.assigned-user {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    border-radius: 50%;
    text-transform: uppercase;
}

.assigned-user .avatar-initial {
    width: 32px;
    height: 32px;
    font-size: 14px;
}

.assigned-user img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
}

/* Professional Ticketing Thread Styles */
.messages-container {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
    background-color: #f8f9fa;
}

.message {
    display: flex;
    flex-direction: column;
    width: 100%;
    background-color: white;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.message:hover {
    box-shadow: var(--shadow-md);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    background-color: var(--background-alt);
}

.message-sender-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.message-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.message-avatar .avatar-initial {
    width: 36px;
    height: 36px;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    border-radius: 50%;
    text-transform: uppercase;
}

.message-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.message-sender {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.message-datetime {
    font-size: 13px;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 4px;
}

.message-body {
    padding: 16px;
    font-size: 14px;
    line-height: 1.6;
    color: var(--text-primary);
    white-space: pre-wrap;
    word-wrap: break-word;
}

.messages-empty {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-secondary);
    font-size: 14px;
}

/* Remove old chat styles */
.message.own {
    flex-direction: column;
}

.message-content {
    max-width: 100%;
}

.message-bubble {
    background-color: transparent;
    padding: 0;
    border-radius: 0;
    box-shadow: none;
}

.message-time {
    display: none;
}

/* Reply/Input Section - Professional Style */
.chat-input-container {
    border-top: 2px solid var(--border);
    padding: 16px;
    background-color: white;
    flex-shrink: 0;
}

.reply-tabs {
    display: flex;
    gap: 16px;
    margin-bottom: 12px;
    border-bottom: 2px solid var(--border);
}

.reply-tab {
    padding: 8px 12px;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-secondary);
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    margin-bottom: -2px;
    transition: var(--transition);
}

.reply-tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
}

.reply-tab:hover {
    color: var(--primary);
}

.chat-input-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    position: relative;
}

.chat-input-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.chat-input-label {
    font-size: 13px;
    color: var(--text-secondary);
    font-weight: 500;
}

.chat-input-wrapper {
    position: relative;
    width: 100%;
}

.chat-input {
    width: 100%;
    padding: 12px 60px 12px 12px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    outline: none;
    font-size: 14px;
    font-family: inherit;
    min-height: 80px;
    resize: vertical;
    transition: var(--transition);
}

.chat-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.chat-input-actions {
    display: none;
}

.chat-input-tools {
    display: none;
}

.tool-btn {
    display: none;
}

.chat-send-btn {
    position: absolute;
    bottom: 8px;
    right: 8px;
    padding: 8px 16px;
    border-radius: var(--radius-md);
    font-weight: 600;
    background-color: var(--primary);
    color: white;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
}

.chat-send-btn:hover {
    background-color: var(--primary-dark);
}

.chat-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Modal */
.modal {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal.hidden { display: none; }

.modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 12px;
    width: 720px;
    max-width: calc(100% - 32px);
    box-shadow: var(--shadow-xl);
    padding: 16px;
    z-index: 2;
}

.modal-header { display: flex; align-items: center; justify-content: space-between; }

.modal-form { display: flex; flex-direction: column; gap: 12px; margin-top: 12px; }

.form-group { display: flex; flex-direction: column; gap: 6px; }

.form-label { font-weight: 600; font-size: 13px; }

.form-input, .form-textarea { padding: 10px; border: 1px solid var(--border); border-radius: var(--radius-md); }

.users-list { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; max-height: 180px; overflow-y: auto; }

.user-checkbox { display: flex; gap: 8px; align-items: center; padding: 8px; border: 1px solid var(--border); border-radius: 8px; cursor: pointer; }

.user-avatar-small {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    border-radius: 50%;
    text-transform: uppercase;
}

.user-avatar-small .avatar-initial {
    width: 36px;
    height: 36px;
    font-size: 14px;
}

.form-error { color: var(--danger); font-weight: 600; }

.form-actions { display: flex; gap: 8px; justify-content: flex-end; }

/* Ensure the card body and app container have a constrained height so left panel can scroll internally */
.card-body {
    /* keep existing visual padding via parent but make layout flex to constrain children */
    padding: 12px; /* small padding inside card */
    display: flex;
    flex-direction: column;
    /* Adjust this value if you have a top header of different height */
    height: calc(100vh - 180px);
    min-height: 0; /* important for flex children to allow internal scrolling */
}

/* Let the app-container fill the card-body */
.app-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Main content should expand and allow children to size properly */
.main-content {
    display: flex;
    flex: 1 1 auto;
    min-height: 0;
}

/* Left panel: allow internal scrolling and ensure its children can shrink */
.ticket-list-panel {
    width: 320px;
    display: flex;
    flex-direction: column;
    min-height: 0; /* critical for overflow to work */
}

/* Make the panel header only as tall as its content */
.panel-header {
    height: auto; /* let content determine height */
    padding: 8px 12px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Panel content should take remaining space and scroll internally */
.panel-content {
    flex: 1 1 auto;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 0;
    min-height: 0; /* allow it to shrink inside flex container */
}

/* Avatar initial styles (replace image avatars with letter avatars) */
.ticket-avatar .avatar-initial,
.assigned-user .avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 600;
    border-radius: 50%;
    text-transform: uppercase;
}
.ticket-avatar .avatar-initial { width: 24px; height: 24px; font-size: 12px; }
.assigned-user .avatar-initial { width: 32px; height: 32px; font-size: 14px; }

/* small responsive tweaks (unchanged) */
@media (max-width: 800px) {
    .ticket-list-panel { width: 100px; }
    .modal-content { width: 100%; }
}
				        </style>

				        <!-- Embedded app.js from mydirectory/app.js (DOM-safe inner script) -->
				        <script>
				        // Users will be loaded from the API endpoint instead of static mock data
const API_USERS_URL = 'https://merz-stage-api.psglobalgroup.com/theranica-api-user-list.php';
// new: ticket creation API endpoint (use local proxy to avoid CORS during development)
// const API_CREATE_TICKET_URL = 'https://merz-stage-api.psglobalgroup.com/theranica-api-ticket-create.php';
// Use the server-side proxy we added to avoid CORS / browser network errors.
// In production you can point this back to the real API or secure the proxy.
const API_CREATE_TICKET_URL = './theranica-ticket-proxy.php';
// new: tickets list API endpoint (use the unified proxy to avoid CORS)
const API_GET_TICKETS_URL = './theranica-ticket-proxy.php';
// new: send message API (proxied)
const API_SEND_MESSAGE_URL = './theranica-ticket-proxy.php';
const API_GET_MESSAGES_URL = './theranica-ticket-proxy.php?get_messages=1';
// Add status change API endpoint
const API_CHANGE_STATUS_URL = './theranica-ticket-proxy.php';

// cache to avoid refetching messages for a ticket unnecessarily
const ticketMessagesLoaded = {};

async function fetchMessagesForTicket(ticketId) {
    const cc = chatContent(); if (!cc) return;
    // show a lightweight loading state
    cc.innerHTML = `\n        <div class="chat-header"><h2 class="chat-title">Loading...</h2></div>\n        <div class="messages-container"><div style="padding:20px; color:var(--text-secondary)">Loading messages...</div></div>`;

    const uid = Number(CURRENT_USER_ID) || 0;
    const params = `&ticket_id=${encodeURIComponent(ticketId)}` + (uid ? `&user_id=${encodeURIComponent(uid)}` : '');
    const url = API_GET_MESSAGES_URL + params;

    try {
        const res = await fetch(url, { method: 'GET', headers: { 'Accept': 'application/json' } });
        const text = await res.text().catch(() => '');
        let data;
        try { data = text ? JSON.parse(text) : {}; } catch (e) { data = text; }
        if (!res.ok) {
            const apiDetail = (data && typeof data === 'object') ? (data.msg || data.message || data.error || JSON.stringify(data)) : (data || `${res.status} ${res.statusText}`);
            throw new Error(apiDetail);
        }

        // API may return wrapper { success:1, messages: [], messageCount: N }
        if (data && typeof data === 'object' && data.success === 0) {
            // API returned an error message in JSON
            const msg = data.msg || data.message || 'Failed to load messages';
            showNotification(msg, 'error');
            ticketMessages[ticketId] = [];
            ticketMessagesLoaded[ticketId] = true;
            // reflect zero count on ticket
            const t = tickets.find(x => x.id === ticketId);
            if (t) t.messageCount = Number(data.messageCount || 0) || 0;
            renderChatContent(ticketId);
            return;
        }

        // locate messages array in response
        let messages = [];
        if (Array.isArray(data)) messages = data;
        else if (Array.isArray(data.messages)) messages = data.messages;
        else if (Array.isArray(data.data)) messages = data.data;
        else if (Array.isArray(data.items)) messages = data.items;
        else {
            // response may be an object with success+messages
            // if no messages found, treat as empty
            messages = [];
        }

        // Normalize messages into the UI shape
        const mapped = (messages || []).map(m => ({
            id: String(m.id || m.ID || m.message_id || m.messageId || ''),
            senderId: String(m.sender_id || m.senderId || m.user_id || m.userId || ''),
            senderName: m.sender_name || m.senderName || m.sender || 'Unknown',
            senderAvatar: SIMPLE_AVATAR_URL,
            message: m.message || m.msg || m.body || '',
            timestamp: m.createdAt || m.created_at || m.timestamp || new Date().toISOString()
        }));

        ticketMessages[ticketId] = mapped;
        ticketMessagesLoaded[ticketId] = true;

        // update ticket message count if present
        const ticket = tickets.find(t => t.id === ticketId);
        if (ticket) ticket.messageCount = Number(data.messageCount || data.message_count || mapped.length || 0);

        renderChatContent(ticketId);
        showNotification('Messages loaded', 'success');
    } catch (err) {
        console.error('Fetch messages error', err);
        const errMsg = err && err.message ? String(err.message) : String(err);
        showNotification('Failed to load messages: ' + errMsg, 'error');
        // ensure arrays exist so UI doesn't break
        ticketMessages[ticketId] = ticketMessages[ticketId] || [];
        // do NOT mark as loaded so clicking again will retry
        // ticketMessagesLoaded[ticketId] = true; // removed to allow retry on subsequent clicks
        renderChatContent(ticketId);
    }
}

// current user id from PHP session (fallback to 0)
const CURRENT_USER_ID = <?php echo isset($session_data['id']) ? intval($session_data['id']) : (isset($session_data['user_id']) ? intval($session_data['user_id']) : 0); ?>;
// Keep SIMPLE_AVATAR_URL for backwards compatibility (not used for display)
const SIMPLE_AVATAR_URL = 'assets/img/default-avatar.png';

// Helpers: initial letter and deterministic color by name
function getInitial(name) {
    if (!name) return '?';
    const s = String(name).trim();
    return s ? s.charAt(0).toUpperCase() : '?';
}
function colorForString(str) {
    const s = String(str || '');
    let hash = 0;
    for (let i = 0; i < s.length; i++) {
        hash = s.charCodeAt(i) + ((hash << 5) - hash);
        hash = hash & hash; // keep 32-bit
    }
    const hue = Math.abs(hash) % 360;
    return `hsl(${hue}, 60%, 45%)`;
}

// enforce 75-character limit UI helpers (simple, minimal change)
function countChars(s) {
    if (!s) return 0;
    return String(s).length;
}

function updateTicketNameCharCount() {
    try {
        const input = document.getElementById('ticketName');
        const help = document.getElementById('ticketNameHelp');
        const submitBtn = ticketForm() ? ticketForm().querySelector('button[type="submit"]') : null;
        if (!input || !help) return;
        const max = Number(input.getAttribute('data-max-chars') || 75);
        const len = countChars(input.value);
        help.textContent = `${len}/${max} chars`;
        help.style.color = len > max ? 'var(--danger)' : 'var(--text-secondary)';
        if (submitBtn) submitBtn.disabled = len === 0;
    } catch (e) { console.warn('updateTicketNameCharCount error', e); }
}

function enforceTicketNameCharLimit() {
    try {
        const input = document.getElementById('ticketName');
        if (!input) return;
        const max = Number(input.getAttribute('data-max-chars') || 75);
        if (input.value.length > max) {
            // truncate to max chars
            input.value = input.value.slice(0, max);
            updateTicketNameCharCount();
            if (formError()) {
                formError().textContent = `Ticket name limited to ${max} characters.`;
                formError().classList.remove('hidden');
                setTimeout(() => { if (formError()) formError().classList.add('hidden'); }, 3000);
            }
            try { input.setSelectionRange(input.value.length, input.value.length); } catch (e) { /* ignore */ }
        }
    } catch (e) { console.warn('enforceTicketNameCharLimit error', e); }
}

// attach simple listeners (typing and paste)
try {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            const tn = document.getElementById('ticketName');
            if (tn) {
                tn.addEventListener('input', () => { enforceTicketNameCharLimit(); updateTicketNameCharCount(); });
                tn.addEventListener('paste', () => { setTimeout(() => { enforceTicketNameCharLimit(); updateTicketNameCharCount(); }, 0); });
                updateTicketNameCharCount();
            }
        });
    } else {
        const tn = document.getElementById('ticketName');
        if (tn) {
            tn.addEventListener('input', () => { enforceTicketNameCharLimit(); updateTicketNameCharCount(); });
            tn.addEventListener('paste', () => { setTimeout(() => { enforceTicketNameCharLimit(); updateTicketNameCharCount(); }, 0); });
            updateTicketNameCharCount();
        }
    }
} catch (e) { /* ignore */ }

// Tickets will be loaded from the API; start empty
let tickets = [];

const ticketMessages = {};

let currentSelectedTicketId = null;
let selectedUserIds = [];

const newTicketBtn = () => document.getElementById('newTicketBtn');
const ticketModal = () => document.getElementById('ticketModal');
const closeModalBtn = () => document.getElementById('closeModalBtn');
const cancelBtn = () => document.getElementById('cancelBtn');
const ticketForm = () => document.getElementById('ticketForm');
const ticketList = () => document.getElementById('ticketList');
const ticketCount = () => document.getElementById('ticketCount');
const chatContent = () => document.getElementById('chatContent');
const usersList = () => document.getElementById('usersList');
const formError = () => document.getElementById('formError');
const notificationBar = () => document.getElementById('notification');

function getStatusSVG(status) {
    if (status === 'open') {
        return `<svg class="status-icon open" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>`;
    } else if (status === 'in-progress') {
        return `<svg class="status-icon in-progress" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>`;
    } else if (status === 'closed') {
        return `<svg class="status-icon closed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`;
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
    const nb = notificationBar(); if (!nb) return;
    nb.textContent = message;
    nb.className = `notification-bar ${type}`;
    setTimeout(() => { nb.classList.add('hidden'); }, 3000);
}

function escapeHtml(text) { const div = document.createElement('div'); div.textContent = text; return div.innerHTML; }

// Fetch users from API and map to the shape used by the UI
async function loadUsersFromApi() {
    try {
        const res = await fetch(API_USERS_URL, { method: 'GET', headers: { 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Failed to load users');
        const data = await res.json();
        // expected fields: id, username, fname, lname, email, is_admin, phi_Compliant
        mockUsers = data.map(u => ({
            id: String(u.id || u.ID || u.user_id || ''),
            name: ((u.fname || '') + ' ' + (u.lname || '')).trim() || (u.username || u.email || 'Unknown'),
            email: u.email || '',
            avatar: SIMPLE_AVATAR_URL
        }));
    } catch (err) {
        console.error('Error loading users:', err);
        // fallback to empty list
        mockUsers = [];
    }
}

// helper to map API ticket objects to local UI ticket shape
function mapApiTickets(apiTickets) {
    if (!Array.isArray(apiTickets)) return [];
    return apiTickets.map(t => ({
        id: String(t.id || t.ID || t.ticket_id || t.ticketId || ''),
        name: t.name || t.title || '',
        summary: t.summary || t.description || '',
        status: t.status || 'open',
        createdAt: t.createdAt || t.created_at || new Date().toISOString(),
        assignedUsers: (t.assignedUsers || t.assigned_users || t.assigned || []).map(u => ({
            id: String(u.id || u.ID || u.user_id || ''),
            fname: u.fname || u.first_name || '',
            lname: u.lname || u.last_name || '',
            name: ((u.fname || '') + ' ' + (u.lname || '')).trim() || u.username || u.email || 'Unknown',
            email: u.email || '',
            avatar: SIMPLE_AVATAR_URL
        })),
        messageCount: Number(t.messageCount || t.message_count || 0)
    }));
}

// Fetch tickets from API and update local tickets list
async function loadTicketsFromApi() {
    try {
        // prefer passing user_id so the API returns tickets for the current user
        const uid = Number(CURRENT_USER_ID) || 0;
        const url = uid ? API_GET_TICKETS_URL + '?user_id=' + encodeURIComponent(uid) : API_GET_TICKETS_URL;
        const res = await fetch(url, { method: 'GET', headers: { 'Accept': 'application/json' } });
        const text = await res.text().catch(() => '');
        let data;
        try { data = text ? JSON.parse(text) : []; } catch (e) { data = text; }
        if (!res.ok) {
            const apiDetail = (data && typeof data === 'object') ? (data.message || data.error || JSON.stringify(data)) : (data || `${res.status} ${res.statusText}`);
            throw new Error(apiDetail);
        }
        // Accept several possible wrapper formats: array, { data: [...] }, { tickets: [...] }, { items: [...] }
        if (!Array.isArray(data)) {
            if (data && typeof data === 'object') {
                if (Array.isArray(data.data)) data = data.data;
                else if (Array.isArray(data.tickets)) data = data.tickets;
                else if (Array.isArray(data.items)) data = data.items;
                else {
                    // If the API returned a success object but not an array, show it for debugging
                    throw new Error('Unexpected tickets response format: ' + JSON.stringify(data).slice(0, 200));
                }
            } else {
                throw new Error('Unexpected tickets response format');
            }
        }
        const mapped = mapApiTickets(data);
        if (mapped.length > 0) {
            tickets = mapped;
            mapped.forEach(t => { if (!ticketMessages[t.id]) ticketMessages[t.id] = []; });
            renderTicketList();
            selectTicket(mapped[0].id);
            showNotification('Tickets loaded from API', 'success');
        }
    } catch (err) {
        console.error('Load tickets API error', err);
        // show non-blocking notification and keep local tickets
        showNotification('Failed to load tickets: ' + (err && err.message ? err.message : String(err)), 'error');
    }
}

// initial load: fetch users and tickets, then render
function initApp() { loadUsersFromApi().then(() => { renderUsersList(); /* then load tickets from API */ loadTicketsFromApi().then(() => { renderTicketList(); renderChatContent(null); }); }); }

function renderTicketList() {
    const tl = ticketList(); if (!tl) return;
    tl.innerHTML = '';
    // apply filter
    const visibleTickets = tickets.filter(t => statusMatchesFilter(t.status, currentFilter));
    if (visibleTickets.length === 0) { tl.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-secondary);">No tickets found</div>'; const tc = ticketCount(); if (tc) tc.textContent = '0 total'; return; }
    const tc = ticketCount(); if (tc) tc.textContent = `${visibleTickets.length} total`;
    visibleTickets.forEach(ticket => {
        const ticketDiv = document.createElement('div');
        ticketDiv.className = `ticket-item ${currentSelectedTicketId === ticket.id ? 'active' : ''}`;
        ticketDiv.onclick = () => selectTicket(ticket.id);
        const avatarsHTML = (ticket.assignedUsers || []).slice(0,3).map(user => {
            const initial = escapeHtml(getInitial(user.name));
            const bg = colorForString(user.name || user.email || user.id);
            return `<div class="ticket-avatar" title="${escapeHtml(user.name)}"><div class="avatar-initial" style="background:${bg}">${initial}</div></div>`;
        }).join('');
        const avatarCountHTML = (ticket.assignedUsers || []).length > 3 ? `<div class="avatar-count">+${ticket.assignedUsers.length - 3}</div>` : '';
        ticketDiv.innerHTML = `\n            <div class="ticket-status">${getStatusSVG(ticket.status)}<span>${ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}</span></div>\n            <h3 class="ticket-name">${escapeHtml(ticket.name)}</h3>\n            <p class="ticket-summary">${escapeHtml(ticket.summary)}</p>\n            <div class="ticket-meta"><div class="ticket-avatars">${avatarsHTML}${avatarCountHTML}</div><div class="ticket-message-count"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><span>${ticket.messageCount}</span></div></div>`;
        tl.appendChild(ticketDiv);
    });
}

function renderChatContent(ticketId) {
    const cc = chatContent(); if (!cc) return;
    if (!ticketId) { cc.innerHTML = `<div class="empty-state"><svg class="empty-state-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><h3 class="empty-state-title">No ticket selected</h3><p class="empty-state-text">Select a ticket from the list to view its details and chat history</p></div>`; return; }
    const ticket = tickets.find(t => t.id === ticketId);
    if (!ticket) { cc.innerHTML = '<div class="empty-state"><p>Ticket not found</p></div>'; return; }
    const messages = ticketMessages[ticketId] || [];
    const assignedUsersHTML = (ticket.assignedUsers && ticket.assignedUsers.length>0) ? ticket.assignedUsers.map(user => {
        const initial = escapeHtml(getInitial(user.name));
        const bg = colorForString(user.name || user.email || user.id);
        return `<div class="assigned-user" title="${escapeHtml(user.name)}"><div class="avatar-initial" style="background:${bg}">${initial}</div></div>`;
    }).join('') : '<p class="unassigned-text">Unassigned</p>';

    // New professional ticketing thread message rendering
    const messagesHTML = messages.length === 0 ? '<div class="messages-empty">No messages yet. Start the conversation!</div>' : messages.map(msg => {
        const initial = escapeHtml(getInitial(msg.senderName || 'Unknown'));
        const bg = colorForString(msg.senderName || 'Unknown');
        const date = new Date(msg.timestamp);
        const fullDateTime = date.toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        return `
            <div class="message">
                <div class="message-header">
                    <div class="message-sender-info">
                        <div class="message-avatar">
                            <div class="avatar-initial" style="background:${bg}">${initial}</div>
                        </div>
                        <div class="message-sender">${escapeHtml(msg.senderName)}</div>
                    </div>
                    <div class="message-datetime">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        ${fullDateTime}
                    </div>
                </div>
                <div class="message-body">${escapeHtml(msg.message)}</div>
            </div>`;
    }).join('');

    // Create status dropdown with current status selected
    const statusOptions = ['open', 'in_progress', 'resolved', 'closed'];
    const statusDropdownHTML = `
        <div class="chat-status-badge">
            ${getStatusSVG(ticket.status)}
            <select id="statusDropdown" class="form-input" style="padding:4px 8px; border-radius:6px; font-size:13px; font-weight:600; border:1px solid var(--border); background:white; min-width:120px;" onchange="onStatusDropdownChange('${ticketId}')">
                ${statusOptions.map(status => `<option value="${status}" ${status === ticket.status ? 'selected' : ''}>${status.charAt(0).toUpperCase() + status.slice(1).replace('_', ' ')}</option>`).join('')}
            </select>
            <button id="statusSaveBtn" class="btn btn-primary" style="padding:4px 12px; font-size:12px; display:none; margin-left:8px;" onclick="handleStatusChange('${ticketId}', document.getElementById('statusDropdown').value)">Save</button>
        </div>
    `;

    cc.innerHTML = `
        <div class="chat-header">
            <div class="chat-header-top">
                <div>
                    ${statusDropdownHTML}
                </div>
                <div class="panel-actions" style="margin-left:auto;">
                    <button id="newTicketBtn" class="btn btn-primary btn-sm">+ New Ticket</button>
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
                <div class="chat-input-wrapper">
                    <textarea class="chat-input" placeholder="Add a reply..." id="messageInput" rows="3" autocomplete="off"></textarea>
                    <button type="submit" class="btn btn-primary chat-send-btn">
                        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        Send
                    </button>
                </div>
            </form>
        </div>
    `;
    setTimeout(() => { const messagesContainer = document.querySelector('.messages-container'); if (messagesContainer) messagesContainer.scrollTop = messagesContainer.scrollHeight; }, 0);
}

function renderUsersList() {
    const ul = usersList(); if (!ul) return; ul.innerHTML = '';
    mockUsers.forEach(user => {
        const label = document.createElement('label'); label.className = 'user-checkbox';
        const isSelected = selectedUserIds.includes(user.id);
        const initial = escapeHtml(getInitial(user.name));
        const bg = colorForString(user.name || user.email || user.id);
        label.innerHTML = `\n            <input type="checkbox" value="${user.id}" ${isSelected ? 'checked' : ''}>\n            <div class="user-avatar-small">\n                <div class="avatar-initial" style="background:${bg}">${initial}</div>\n            </div>\n            <div class="user-info">\n                <div class="user-name">${escapeHtml(user.name)}</div>\n                <div class="user-email">${escapeHtml(user.email)}</div>\n            </div>\n        `;
        const checkbox = label.querySelector('input[type="checkbox"]');
        checkbox.addEventListener('change', (e) => { if (e.target.checked) selectedUserIds.push(user.id); else selectedUserIds = selectedUserIds.filter(id => id !== user.id); });
        ul.appendChild(label);
    });
}

function selectTicket(ticketId) { currentSelectedTicketId = ticketId; renderTicketList();
    if (ticketMessagesLoaded[ticketId]) {
        renderChatContent(ticketId);
    } else {
        // fire-and-forget fetch; renderChatContent will be called after loading completes
        fetchMessagesForTicket(ticketId);
    }
}

function handleSendMessage(event, ticketId) { event.preventDefault(); const input = document.getElementById('messageInput'); if (!input) return; const message = input.value.trim(); if (!message) return;
    // prepare local temporary message for optimistic UI
    const tempId = 'm' + Date.now();
    const newMessage = { id: tempId, senderId: String(CURRENT_USER_ID) || 'current-user', senderName: 'You', senderAvatar: SIMPLE_AVATAR_URL, message: message, timestamp: new Date().toISOString() };
    if (!ticketMessages[ticketId]) ticketMessages[ticketId] = [];
    ticketMessages[ticketId].push(newMessage);

    // increment message count on ticket locally
    const ticket = tickets.find(t => t.id === ticketId);
    if (ticket) ticket.messageCount = (Number(ticket.messageCount) || 0) + 1;

    // update UI immediately
    renderChatContent(ticketId);
    // clear input and keep focus
    input.value = '';
    input.focus();

    // disable send button to prevent duplicate sends
    const sendBtn = document.querySelector('.chat-send-btn');
    if (sendBtn) sendBtn.disabled = true;

    // build payload for API
    const payload = {
        ticket_id: Number(ticketId) || 0,
        sender_id: Number(CURRENT_USER_ID) || 0,
        message: message
    };

    // POST to proxied send-message endpoint
    fetch(API_SEND_MESSAGE_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(async (res) => {
        const text = await res.text().catch(() => '');
        let data;
        try { data = text ? JSON.parse(text) : {}; } catch (e) { data = text; }
        if (!res.ok) {
            const apiDetail = (data && typeof data === 'object') ? (data.message || data.error || JSON.stringify(data)) : (data || `${res.status} ${res.statusText}`);
            throw new Error(apiDetail);
        }
        return data;
    })
    .then((data) => {
        // Optionally replace the temp message id with real id returned by API
        const returnedId = data && (data.id || data.message_id || data.messageId || data.ID);
        if (returnedId) {
            const msgs = ticketMessages[ticketId] || [];
            for (let m of msgs) { if (m.id === tempId) { m.id = String(returnedId); break; } }
        }
        showNotification('Message sent', 'success');
    })
    .catch((err) => {
        console.error('Send message API error', err);
        const errMsg = err && err.message ? String(err.message) : String(err);
        // show notification of failure but keep optimistic message locally so user doesn't lose it
        showNotification('Message saved locally (API failed): ' + errMsg, 'error');
    })
    .finally(() => { if (sendBtn) sendBtn.disabled = false; });
}

function openModal() { selectedUserIds = []; if (ticketForm()) ticketForm().reset(); if (formError()) formError().classList.add('hidden'); renderUsersList(); if (ticketModal()) ticketModal().classList.remove('hidden'); }
function closeModal() { if (ticketModal()) ticketModal().classList.add('hidden'); }

function handleCreateTicket(event) { event.preventDefault(); if (formError()) formError().classList.add('hidden'); const nameInput = document.getElementById('ticketName'); const name = nameInput ? nameInput.value.trim() : ''; const summary = document.getElementById('ticketSummary').value.trim(); // enforce char-limit
    const maxChars = nameInput ? Number(nameInput.getAttribute('data-max-chars') || 75) : 75;
    const nameLen = countChars(name);
    if (nameLen > maxChars) {
        if (formError()) { formError().textContent = `Ticket name cannot exceed ${maxChars} characters (currently ${nameLen}).`; formError().classList.remove('hidden'); }
        updateTicketNameCharCount();
        return;
    }
     if (!name) { if (formError()) { formError().textContent = 'Ticket name is required'; formError().classList.remove('hidden'); } return; } if (!summary) { if (formError()) { formError().textContent = 'Summary is required'; formError().classList.remove('hidden'); } return; }
    // prepare participants as numeric ids for the API
    const participants = selectedUserIds.map(id => Number(id));

    // build payload according to the API sample
    const payload = {
        title: name,
        description: summary,
        created_by: Number(CURRENT_USER_ID) || 0,
        participants: participants,
        message: ''
    };

    // disable submit button to prevent duplicate submits
    const submitBtn = ticketForm() ? ticketForm().querySelector('button[type="submit"]') : null;
    if (submitBtn) submitBtn.disabled = true;

    // send to remote API; on success use returned id if available, otherwise fallback to local creation
    fetch(API_CREATE_TICKET_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(async (res) => {
        // read raw response text, try to parse JSON, but preserve raw text for error messages
        const text = await res.text().catch(() => '');
        let data;
        try { data = text ? JSON.parse(text) : {}; } catch (e) { data = text; }
        if (!res.ok) {
            const apiDetail = (data && typeof data === 'object') ? (data.message || data.error || JSON.stringify(data)) : (data || `${res.status} ${res.statusText}`);
            throw new Error(apiDetail);
        }
        return data;
    })
    .then((data) => {
        // Try to extract an id from the API response
        const returnedId = data && (data.id || data.ticket_id || data.ticketId || data.ID || data.ticket);
        const assignedUsers = mockUsers.filter(u => selectedUserIds.includes(u.id));
        const ticketId = returnedId ? String(returnedId) : String(tickets.length + 1);
        const newTicket = { id: ticketId, name: name, summary: summary, status: 'open', createdAt: new Date().toISOString(), assignedUsers: assignedUsers, messageCount: 0 };
        tickets.unshift(newTicket);
        ticketMessages[newTicket.id] = [];
        renderTicketList();
        selectTicket(newTicket.id);
        closeModal();
        showNotification('Ticket created successfully!', 'success');
    })
    .catch((err) => {
        console.error('Create ticket API error', err);
        const errMsg = err && err.message ? String(err.message) : String(err);
        // show error in the form area so the user sees the exact API error
        if (formError()) {
            formError().textContent = 'API error: ' + errMsg;
            formError().classList.remove('hidden');
        }
        // fallback: create ticket locally so UI still works
        const assignedUsers = mockUsers.filter(u => selectedUserIds.includes(u.id));
        const newTicket = { id: String(tickets.length + 1), name: name, summary: summary, status: 'open', createdAt: new Date().toISOString(), assignedUsers: assignedUsers, messageCount: 0 };
        tickets.unshift(newTicket);
        ticketMessages[newTicket.id] = [];
        renderTicketList();
        selectTicket(newTicket.id);
        // show notification including the API error details
        showNotification('Ticket created locally (API failed): ' + errMsg, 'error');
    })
    .finally(() => { if (submitBtn) submitBtn.disabled = false; });
}

function initApp() { loadUsersFromApi().then(() => { renderUsersList(); /* then load tickets from API */ loadTicketsFromApi().then(() => { renderTicketList(); renderChatContent(null); }); }); }

// Add status change function
async function handleStatusChange(ticketId, newStatus) {
    const ticket = tickets.find(t => t.id === ticketId);
    if (!ticket) return;

    const payload = {
        ticket_id: Number(ticketId) || 0,
        user_id: Number(CURRENT_USER_ID) || 0,
        status: newStatus,
        create_message: true
    };

    try {
        const res = await fetch(API_CHANGE_STATUS_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        });

        const text = await res.text().catch(() => '');
        let data;
        try { data = text ? JSON.parse(text) : {}; } catch (e) { data = text; }

        if (!res.ok) {
            const apiDetail = (data && typeof data === 'object') ? (data.message || data.error || JSON.stringify(data)) : (data || `${res.status} ${res.statusText}`);
            throw new Error(apiDetail);
        }

        // Update local ticket status
        ticket.status = newStatus;
        renderTicketList();
        renderChatContent(ticketId);
        showNotification('Status updated successfully', 'success');

        // Hide save button after successful update
        const saveBtn = document.getElementById('statusSaveBtn');
        if (saveBtn) saveBtn.style.display = 'none';

    } catch (err) {
        console.error('Status change API error', err);
        const errMsg = err && err.message ? String(err.message) : String(err);
        showNotification('Failed to update status: ' + errMsg, 'error');
    }
}

// Function to handle status dropdown change
function onStatusDropdownChange(ticketId) {
    const dropdown = document.getElementById('statusDropdown');
    const saveBtn = document.getElementById('statusSaveBtn');
    const ticket = tickets.find(t => t.id === ticketId);

    if (!dropdown || !ticket) return;

    // Show save button if status changed
    if (dropdown.value !== ticket.status) {
        if (saveBtn) saveBtn.style.display = 'inline-block';
    } else {
        if (saveBtn) saveBtn.style.display = 'none';
    }
}
document.addEventListener('click', function(e){ if (e.target && e.target.id === 'newTicketBtn') openModal(); });
if (closeModalBtn()) closeModalBtn().addEventListener('click', closeModal);
function adjustCardHeight() {
    try {
        const card = document.querySelector('.card');
        if (!card) return;
        // compute available height inside viewport excluding top nav/footer
        const pageHeader = document.querySelector('.navbar') || document.querySelector('header') || document.querySelector('.page-header');
        const pageFooter = document.querySelector('footer') || document.querySelector('.footer');
        const headerH = pageHeader ? pageHeader.getBoundingClientRect().height : 0;
        const footerH = pageFooter ? pageFooter.getBoundingClientRect().height : 0;
        const extra = 32; // small spacing
        const available = Math.max(320, window.innerHeight - headerH - footerH - extra);
        card.style.height = available + 'px';

        const cardBody = card.querySelector('.card-body');
        if (cardBody) {
            cardBody.style.height = '100%';
            cardBody.style.minHeight = '0';
            // Now set panel-content height explicitly to prevent page scroll
            const panelHeader = cardBody.querySelector('.ticket-list-panel .panel-header');
            const panelContent = cardBody.querySelector('.ticket-list-panel .panel-content');
            // compute content height: cardBody height minus any other siblings (header, paddings)
            const bodyRect = cardBody.getBoundingClientRect();
            const headerHeight = panelHeader ? panelHeader.getBoundingClientRect().height : 0;
            // consider chat header heights? we only adjust left panel
            const contentAvailable = Math.max(120, bodyRect.height - headerHeight - 24); // small extra for paddings
            if (panelContent) {
                panelContent.style.height = contentAvailable + 'px';
                panelContent.style.overflowY = 'auto';
            }
        }
    } catch (e) {
        console.warn('adjustCardHeight error', e);
    }
}

window.addEventListener('resize', adjustCardHeight);
// call after DOM ready in initApp
const _origInitApp = initApp;
function initAppWrapper() {
    adjustCardHeight();
    _origInitApp();
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAppWrapper);
} else {
    initAppWrapper();
}
if (ticketForm()) ticketForm().addEventListener('submit', handleCreateTicket);

if (ticketModal()) ticketModal().addEventListener('click', (e) => { if (e.target === ticketModal() || e.target === ticketModal().querySelector('.modal-overlay')) closeModal(); });

if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', initApp); } else { initApp(); }

// filtering state and helpers
let currentFilter = 'all';
function statusMatchesFilter(status, filter) {
    if (!filter || filter === 'all') return true;
    const s = String(status || '').toLowerCase().replace(/_/g, '-');
    const f = String(filter || '').toLowerCase();
    if (f === 'resolved') return s === 'resolved' || s === 'closed';
    if (f === 'in_progress') return s === 'in-progress' || s === 'in_progress' || s === 'inprogress';

    return s === f.replace(/_/g, '-');
}

// attach filter listener after DOM initialization
(function attachFilterListener(){
    try {
        const sel = document.getElementById('ticketFilterSelect');
        if (!sel) return;
        sel.addEventListener('change', (e) => {
            currentFilter = e.target.value || 'all';
            // determine visible tickets after filter
            const visible = tickets.filter(t => statusMatchesFilter(t.status, currentFilter));
            if (visible.length > 0) {
                // select the first visible ticket
                selectTicket(visible[0].id);
            } else {
                currentSelectedTicketId = null;
                renderTicketList();
                renderChatContent(null);
            }
        });
    } catch (e) { /* ignore */ }
})();
				        </script>
				    </div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$('.delete_prompt').click(function(e){
			e.preventDefault();
			confirm('Are you sure you want to delete the user');
		})
	</script>
		<?php endif;?>
	</div>
<?php require_once('footer.php');?>
