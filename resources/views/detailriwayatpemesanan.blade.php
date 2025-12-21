@extends('app')
@section('title', 'Detail Pemesanan - Nukang')
@section('content')

	<style>
		/* =====================================================
		   PREMIUM FUTURISTIC DESIGN SYSTEM
		   Modern Glassmorphic UI for Order Detail Page
		   ===================================================== */
		
		/* Keyframe Animations */
		@keyframes gradientShift {
			0% { background-position: 0% 50%; }
			50% { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}
		
		@keyframes float {
			0%, 100% { transform: translateY(0px); }
			50% { transform: translateY(-10px); }
		}
		
		@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.5; }
		}
		
		@keyframes glow {
			0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
			50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); }
		}
		
		@keyframes slideInUp {
			from { opacity: 0; transform: translateY(30px); }
			to { opacity: 1; transform: translateY(0); }
		}
		
		@keyframes borderGlow {
			0%, 100% { border-color: rgba(16, 185, 129, 0.3); }
			50% { border-color: rgba(6, 182, 212, 0.6); }
		}
		
		@keyframes shimmer {
			0% { background-position: -200% 0; }
			100% { background-position: 200% 0; }
		}
		
		@keyframes ringPulse {
			0% { transform: scale(1); opacity: 1; }
			100% { transform: scale(1.3); opacity: 0; }
		}
		
		/* Premium Page Container */
		.order-detail-page {
			padding: var(--space-6) 0;
			min-height: 100vh;
			animation: slideInUp 0.6s ease-out;
		}


		/* ======================
		   HEADER SECTION
		   ====================== */
		.order-header-section {
			background: var(--bg-card);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			padding: var(--space-5);
			margin-bottom: var(--space-5);
			position: relative;
		}
		
		.order-header-section::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background: var(--gradient-primary);
			border-radius: var(--radius-xl) var(--radius-xl) 0 0;
		}

		.order-header-top {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: var(--space-4);
		}

		.order-id-display {
			display: flex;
			flex-direction: column;
			gap: var(--space-1);
		}

		.order-id-label {
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 1px;
			color: var(--text-tertiary);
			font-weight: 600;
		}

		.order-id-value {
			font-family: 'SF Mono', 'Fira Code', monospace;
			font-size: 1.25rem;
			font-weight: 700;
			color: var(--success);
			letter-spacing: 1px;
		}

		/* Order Header Card */
		.order-header {
			background: var(--bg-card);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			padding: var(--space-4) var(--space-5);
			margin-bottom: var(--space-5);
			position: relative;
			overflow: hidden;
		}

		.order-header::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background: var(--gradient-primary);
			border-radius: var(--radius-xl) var(--radius-xl) 0 0;
		}

		.order-number {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: var(--space-3);
		}

		.order-number-badge {
			font-family: 'SF Mono', 'Fira Code', monospace;
			font-size: 1.1rem;
			font-weight: 700;
			color: var(--success);
		}
		
		.hero-top {
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: var(--space-4);
			margin-bottom: var(--space-6);
		}
		
		.order-id-display {
			display: flex;
			align-items: center;
			gap: var(--space-4);
		}
		
		.order-id-label {
			font-size: 0.75rem;
			text-transform: uppercase;
			letter-spacing: 2px;
			color: var(--text-tertiary);
			font-weight: 600;
		}
		
		.order-id-value {
			font-family: 'SF Mono', 'Fira Code', monospace;
			font-size: 1.75rem;
			font-weight: 800;
			background: linear-gradient(135deg, var(--success), var(--info));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			letter-spacing: 2px;
		}
		
		/* Status Timeline */
		.status-timeline {
			display: flex;
			align-items: center;
			gap: 0;
			padding: var(--space-4) var(--space-6);
			background: rgba(255, 255, 255, 0.03);
			backdrop-filter: blur(10px);
			border-radius: var(--radius-xl);
			border: 1px solid rgba(255, 255, 255, 0.08);
		}
		
		.timeline-step {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: var(--space-2);
			position: relative;
			flex: 1;
		}
		
		.timeline-step:not(:last-child)::after {
			content: '';
			position: absolute;
			top: 18px;
			left: 60%;
			width: 80%;
			height: 3px;
			background: var(--border-primary);
			z-index: 0;
		}
		
		.timeline-step.completed:not(:last-child)::after {
			background: linear-gradient(90deg, var(--success), var(--info));
		}
		
		.timeline-step.active:not(:last-child)::after {
			background: linear-gradient(90deg, var(--success) 50%, var(--border-primary) 50%);
		}
		
		.timeline-dot {
			width: 36px;
			height: 36px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.8rem;
			position: relative;
			z-index: 1;
			transition: all 0.3s ease;
			background: var(--bg-tertiary);
			border: 2px solid var(--border-primary);
			color: var(--text-tertiary);
		}
		
		.timeline-step.completed .timeline-dot {
			background: var(--gradient-primary);
			border-color: transparent;
			color: white;
		}
		
		.timeline-step.active .timeline-dot {
			background: var(--gradient-primary);
			border-color: transparent;
			color: white;
			animation: glow 2s ease-in-out infinite;
		}
		
		.timeline-step.active .timeline-dot::before {
			content: '';
			position: absolute;
			inset: -4px;
			border-radius: 50%;
			border: 2px solid var(--success);
			animation: ringPulse 2s ease-out infinite;
		}
		
		.timeline-label {
			font-size: 0.7rem;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			color: var(--text-tertiary);
			text-align: center;
		}
		
		.timeline-step.completed .timeline-label,
		.timeline-step.active .timeline-label {
			color: var(--success);
		}
		
		/* Status Badges - Premium */
		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			padding: var(--space-2) var(--space-5);
			border-radius: var(--radius-full);
			font-size: 0.875rem;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 1px;
			position: relative;
			overflow: hidden;
		}
		
		.status-badge::before {
			content: '';
			position: absolute;
			inset: 0;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
			transform: translateX(-100%);
			animation: shimmer 2s ease-in-out infinite;
		}
		
		.status-badge i {
			font-size: 0.75rem;
		}

		.status-menunggu {
			background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(251, 191, 36, 0.2));
			border: 1px solid rgba(245, 158, 11, 0.4);
			color: #fbbf24;
			box-shadow: 0 4px 20px rgba(245, 158, 11, 0.2);
		}

		.status-diterima,
		.status-dikerjakan {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.2));
			border: 1px solid rgba(59, 130, 246, 0.4);
			color: #60a5fa;
			box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
		}

		.status-selesai {
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 182, 212, 0.2));
			border: 1px solid rgba(16, 185, 129, 0.4);
			color: #34d399;
			box-shadow: 0 4px 20px rgba(16, 185, 129, 0.2);
		}

		.status-ditolak {
			background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(244, 63, 94, 0.2));
			border: 1px solid rgba(239, 68, 68, 0.4);
			color: #f87171;
			box-shadow: 0 4px 20px rgba(239, 68, 68, 0.2);
		}

		/* ======================
		   CARD STYLES
		   ====================== */
		.glass-card {
			background: var(--bg-card);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			transition: all 0.3s ease;
			overflow: hidden;
		}
		
		.glass-card:hover {
			border-color: rgba(16, 185, 129, 0.3);
			box-shadow: 
				0 16px 40px rgba(0, 0, 0, 0.25),
				0 0 20px rgba(16, 185, 129, 0.08);
			transform: translateY(-4px);
		}

		/* ======================
		   PROVIDER CARD
		   ====================== */
		.provider-card {
			background: var(--bg-card);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			margin-bottom: var(--space-5);
			transition: all 0.3s ease;
			overflow: hidden;
		}

		.provider-card:hover {
			border-color: rgba(16, 185, 129, 0.3);
			box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
		}

		.provider-card-header {
			background: var(--bg-tertiary);
			padding: var(--space-5);
			border-bottom: 1px solid var(--border-primary);
		}

		.provider-card-inner {
			display: flex;
			align-items: center;
			gap: var(--space-6);
			flex-wrap: wrap;
			position: relative;
			z-index: 1;
		}

		@media (max-width: 768px) {
			.provider-card-inner {
				flex-direction: column;
				text-align: center;
			}
		}

		.provider-avatar-wrapper {
			position: relative;
			flex-shrink: 0;
		}

		.provider-avatar {
			width: 80px;
			height: 80px;
			border-radius: 50%;
			position: relative;
			border: 3px solid var(--success);
		}

		.provider-avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			border-radius: 50%;
		}

		.provider-avatar-placeholder {
			width: 100%;
			height: 100%;
			border-radius: 50%;
			background: linear-gradient(135deg, var(--success), var(--info));
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 2.5rem;
			color: white;
			font-weight: 700;
		}

		.provider-verified-badge {
			position: absolute;
			bottom: 5px;
			right: 5px;
			width: 32px;
			height: 32px;
			background: linear-gradient(135deg, var(--success), var(--info));
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 0.85rem;
			border: 3px solid var(--bg-secondary);
			box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
		}

		.provider-details {
			flex: 1;
			min-width: 200px;
		}

		.provider-code {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			background: rgba(16, 185, 129, 0.1);
			padding: var(--space-1) var(--space-3);
			border-radius: var(--radius-md);
			font-family: 'SF Mono', 'Fira Code', monospace;
			font-size: 0.7rem;
			color: var(--success);
			margin-bottom: var(--space-2);
			text-transform: uppercase;
			letter-spacing: 1px;
			border: 1px solid rgba(16, 185, 129, 0.2);
		}

		.provider-name {
			font-size: 1.75rem;
			font-weight: 800;
			color: var(--text-primary);
			margin-bottom: var(--space-2);
			letter-spacing: -0.5px;
		}

		.provider-location {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			color: var(--text-secondary);
			font-size: 0.9rem;
			padding: var(--space-2) var(--space-3);
			background: rgba(255, 255, 255, 0.03);
			border-radius: var(--radius-md);
			margin-top: var(--space-2);
		}

		.provider-location i {
			color: var(--success);
			font-size: 1rem;
		}

		.provider-category {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(6, 182, 212, 0.15));
			border: 1px solid rgba(16, 185, 129, 0.3);
			padding: var(--space-2) var(--space-4);
			border-radius: var(--radius-full);
			font-size: 0.85rem;
			font-weight: 700;
			color: var(--success);
			margin-top: var(--space-3);
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		
		.provider-category i {
			font-size: 0.8rem;
		}

		.provider-stats {
			display: flex;
			align-items: center;
			gap: var(--space-6);
			margin-top: var(--space-4);
			padding-top: var(--space-4);
			border-top: 1px solid rgba(255, 255, 255, 0.05);
		}

		.provider-stat {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: var(--space-1);
		}

		.provider-stat-value {
			font-size: 1.25rem;
			font-weight: 800;
			background: linear-gradient(135deg, var(--success), var(--info));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.provider-stat-value i {
			-webkit-text-fill-color: var(--warning);
			font-size: 0.9rem;
		}

		.provider-stat-label {
			font-size: 0.75rem;
			color: var(--text-tertiary);
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.provider-action {
			display: flex;
			flex-direction: column;
			gap: var(--space-3);
			align-items: flex-end;
		}

		@media (max-width: 768px) {
			.provider-action {
				align-items: center;
				width: 100%;
			}
		}

		/* Rating Stars */
		.rating-stars {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: var(--space-1);
			margin: var(--space-3) 0;
		}

		.rating-stars i {
			color: #fbbf24;
			font-size: 1rem;
		}

		.rating-stars i.empty {
			color: var(--text-tertiary);
		}

		.rating-text {
			margin-left: var(--space-2);
			color: var(--text-secondary);
			font-size: 0.875rem;
		}

		/* ======================
		   DETAIL CARD
		   ====================== */
		.detail-card {
			background: var(--bg-card);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			padding: var(--space-5);
			margin-bottom: var(--space-5);
		}

		.detail-card-title {
			display: flex;
			align-items: center;
			gap: var(--space-3);
			font-size: 1.1rem;
			font-weight: 700;
			color: var(--text-primary);
			margin-bottom: var(--space-5);
			padding-bottom: var(--space-4);
			border-bottom: 1px solid var(--border-primary);
		}

		.detail-card-title i {
			width: 40px;
			height: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
			background: var(--gradient-primary);
			border-radius: var(--radius-md);
			color: white;
			font-size: 1rem;
		}

		/* Detail Grid - Fixed 4 columns for consistent alignment */
		.detail-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: var(--space-4);
		}

		@media (max-width: 992px) {
			.detail-grid {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		@media (max-width: 576px) {
			.detail-grid {
				grid-template-columns: 1fr;
			}
		}

		.detail-item {
			display: flex;
			flex-direction: column;
			gap: var(--space-2);
			padding: var(--space-4);
			background: var(--bg-tertiary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-lg);
			text-align: center;
			min-height: 90px;
			transition: all 0.3s ease;
		}
		
		.detail-item:hover {
			background: rgba(16, 185, 129, 0.05);
			border-color: rgba(16, 185, 129, 0.3);
		}

		.detail-item-icon {
			width: 36px;
			height: 36px;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgba(16, 185, 129, 0.1);
			border-radius: var(--radius-md);
			color: var(--success);
			flex-shrink: 0;
			margin: 0 auto;
			font-size: 0.9rem;
		}

		.detail-item-content {
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.detail-item-label {
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 1px;
			color: var(--text-tertiary);
			margin-bottom: var(--space-2);
			font-weight: 600;
		}

		.detail-item-value {
			font-size: 0.95rem;
			color: var(--text-primary);
			font-weight: 700;
		}

		.detail-item-value a {
			color: var(--success);
			text-decoration: none;
			transition: all 0.2s ease;
		}

		.detail-item-value a:hover {
			color: var(--info);
		}

		.detail-item-content {
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.detail-item-label {
			font-size: 0.7rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			color: var(--text-tertiary);
			margin-bottom: var(--space-1);
		}

		.detail-item-value {
			font-size: 0.9rem;
			color: var(--text-primary);
			font-weight: 600;
		}

		.detail-item-value a {
			color: var(--success);
			text-decoration: none;
		}

		.detail-item-value a:hover {
			text-decoration: underline;
		}

		/* Price Card */
		.price-card {
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1));
			border: 1px solid rgba(16, 185, 129, 0.2);
			border-radius: var(--radius-lg);
			padding: var(--space-4);
			margin-top: var(--space-4);
		}

		.price-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: var(--space-2) 0;
		}

		.price-row:not(:last-child) {
			border-bottom: 1px dashed rgba(16, 185, 129, 0.2);
		}

		.price-label {
			color: var(--text-secondary);
			font-size: 0.9rem;
		}

		.price-value {
			font-weight: 600;
			color: var(--text-primary);
		}

		.price-row.total {
			margin-top: var(--space-3);
			padding-top: var(--space-3);
			border-top: 2px solid rgba(16, 185, 129, 0.3);
		}

		.price-row.total .price-label {
			font-weight: 700;
			color: var(--text-primary);
		}

		.price-row.total .price-value {
			font-size: 1.25rem;
			color: var(--success);
		}

		/* Notes Card */
		.notes-card {
			background: var(--bg-tertiary);
			border-radius: var(--radius-lg);
			padding: var(--space-4);
			margin-top: var(--space-4);
		}

		.notes-label {
			font-size: 0.75rem;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			color: var(--text-tertiary);
			margin-bottom: var(--space-2);
		}

		.notes-content {
			color: var(--text-secondary);
			font-style: italic;
		}

		/* Rejection Card */
		.rejection-card {
			background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(244, 63, 94, 0.1));
			border: 1px solid rgba(239, 68, 68, 0.2);
			border-radius: var(--radius-lg);
			padding: var(--space-4);
			margin-top: var(--space-4);
		}

		.rejection-card .notes-label {
			color: #ef4444;
		}

		.rejection-card .notes-content {
			color: #fca5a5;
		}

		/* Material Cart - Premium Styling */
		.cart-card {
			background: var(--bg-secondary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			padding: 0;
			overflow: hidden;
		}

		.cart-card .detail-card-title {
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1));
			border-bottom: 1px solid var(--border-primary);
			padding: var(--space-4) var(--space-5);
			margin-bottom: 0;
		}

		.cart-card-body {
			padding: var(--space-4) var(--space-5);
		}

		.cart-empty {
			text-align: center;
			padding: var(--space-8) var(--space-5);
			color: var(--text-tertiary);
		}

		.cart-empty i {
			font-size: 3.5rem;
			margin-bottom: var(--space-4);
			opacity: 0.4;
			background: var(--gradient-primary);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}

		.cart-empty p {
			font-size: 0.95rem;
		}

		.cart-item {
			display: flex;
			align-items: center;
			gap: var(--space-4);
			padding: var(--space-4);
			background: var(--bg-tertiary);
			border-radius: var(--radius-lg);
			margin: var(--space-3) var(--space-5);
			transition: all 0.3s ease;
			border: 1px solid transparent;
		}

		.cart-item:first-of-type {
			margin-top: var(--space-4);
		}

		.cart-item:last-of-type {
			margin-bottom: var(--space-4);
		}

		.cart-item:hover {
			background: var(--bg-primary);
			border-color: rgba(16, 185, 129, 0.3);
			transform: translateX(4px);
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
		}

		.cart-item-image {
			width: 60px;
			height: 60px;
			border-radius: var(--radius-md);
			object-fit: cover;
			border: 2px solid var(--border-primary);
			flex-shrink: 0;
		}

		.cart-item-info {
			flex: 1;
			min-width: 0;
		}

		.cart-item-code {
			font-family: 'Courier New', monospace;
			font-size: 0.7rem;
			color: var(--text-tertiary);
			margin-bottom: var(--space-1);
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.cart-item-name {
			font-weight: 600;
			color: var(--text-primary);
			font-size: 0.95rem;
			margin-bottom: var(--space-1);
		}

		.cart-item-price {
			color: var(--success);
			font-size: 0.9rem;
			font-weight: 600;
		}

		.cart-item-qty {
			background: var(--gradient-primary);
			color: white;
			padding: var(--space-2) var(--space-3);
			border-radius: var(--radius-md);
			font-weight: 700;
			font-size: 0.9rem;
			min-width: 50px;
			text-align: center;
			box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
		}

		.cart-item-status {
			padding: var(--space-1) var(--space-3);
			border-radius: var(--radius-full);
			font-size: 0.75rem;
			font-weight: 600;
		}

		.cart-item-status.pending {
			background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(251, 191, 36, 0.15));
			color: #f59e0b;
			border: 1px solid rgba(245, 158, 11, 0.3);
		}

		.cart-item-status.purchased {
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(6, 182, 212, 0.15));
			color: var(--success);
			border: 1px solid rgba(16, 185, 129, 0.3);
		}

		.cart-item-actions {
			display: flex;
			gap: var(--space-2);
		}

		.cart-item-actions a {
			color: #ef4444;
			font-size: 1rem;
			padding: var(--space-2);
			border-radius: var(--radius-md);
			transition: all 0.2s ease;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.cart-item-actions a:hover {
			background: rgba(239, 68, 68, 0.1);
			transform: scale(1.1);
		}

		.cart-summary {
			background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1));
			border-top: 1px solid var(--border-primary);
			padding: var(--space-4) var(--space-5);
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.cart-summary-label {
			font-weight: 600;
			color: var(--text-secondary);
		}

		.cart-summary-value {
			font-size: 1.25rem;
			font-weight: 700;
			color: var(--success);
		}

		/* Back Button */
		.btn-back {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			padding: var(--space-2) var(--space-4);
			background: var(--bg-secondary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-lg);
			color: var(--text-primary);
			text-decoration: none;
			font-weight: 500;
			font-size: 0.9rem;
			transition: all 0.3s ease;
			margin-bottom: var(--space-4);
		}

		.btn-back:hover {
			background: var(--bg-tertiary);
			border-color: var(--success);
			color: var(--success);
			transform: translateX(-2px);
			text-decoration: none;
		}

		.btn-back i {
			font-size: 0.875rem;
		}

		/* Action Buttons */
		.action-buttons {
			display: flex;
			flex-wrap: wrap;
			gap: var(--space-3);
			margin-top: var(--space-6);
			justify-content: center;
		}

		.btn-premium {
			display: inline-flex;
			align-items: center;
			gap: var(--space-2);
			padding: var(--space-3) var(--space-6);
			border-radius: var(--radius-lg);
			font-weight: 600;
			font-size: 0.95rem;
			text-decoration: none;
			transition: all 0.3s ease;
			border: none;
			cursor: pointer;
		}

		.btn-premium-primary {
			background: var(--gradient-primary);
			color: white;
			box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
		}

		.btn-premium-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
			color: white;
		}

		.btn-premium-secondary {
			background: var(--bg-tertiary);
			color: var(--text-primary);
			border: 1px solid var(--border-primary);
		}

		.btn-premium-secondary:hover {
			background: var(--bg-secondary);
			border-color: var(--success);
			color: var(--success);
		}

		/* Progress Timeline Modal */
		.progress-timeline {
			position: relative;
			padding-left: var(--space-8);
		}

		.progress-timeline::before {
			content: '';
			position: absolute;
			left: 15px;
			top: 0;
			bottom: 0;
			width: 2px;
			background: linear-gradient(to bottom, var(--success), var(--border-primary));
		}

		.progress-item {
			position: relative;
			padding: var(--space-4);
			background: var(--bg-tertiary);
			border-radius: var(--radius-lg);
			margin-bottom: var(--space-4);
			transition: all 0.3s ease;
		}

		.progress-item:hover {
			background: var(--bg-secondary);
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
		}

		.progress-item::before {
			content: '';
			position: absolute;
			left: -41px;
			top: 20px;
			width: 12px;
			height: 12px;
			background: var(--success);
			border-radius: 50%;
			border: 3px solid var(--bg-secondary);
			box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
		}

		.progress-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: var(--space-3);
		}

		.progress-author {
			font-weight: 600;
			color: var(--text-primary);
		}

		.progress-date {
			font-size: 0.8rem;
			color: var(--text-tertiary);
		}

		.progress-content {
			color: var(--text-secondary);
			margin-bottom: var(--space-3);
			line-height: 1.6;
		}

		.progress-images {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
			gap: var(--space-2);
		}

		.progress-images img {
			width: 100%;
			height: 80px;
			object-fit: cover;
			border-radius: var(--radius-md);
			transition: transform 0.3s ease;
			cursor: pointer;
		}

		.progress-images img:hover {
			transform: scale(1.05);
		}

		.progress-actions {
			display: flex;
			gap: var(--space-2);
			margin-top: var(--space-3);
		}

		/* Premium Modal */
		.modal.fade {
			display: none;
			position: fixed !important;
			top: 0 !important;
			left: 0 !important;
			width: 100% !important;
			height: 100% !important;
			z-index: 1050 !important;
			background: rgba(0, 0, 0, 0.5) !important;
			opacity: 0;
			transition: opacity 0.15s linear;
		}

		.modal.fade.show,
		.modal.fade.in {
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			opacity: 1;
		}

		.modal-dialog {
			max-width: 700px !important;
			margin: auto !important;
		}

		.modal-content {
			background: var(--bg-secondary) !important;
			border: 1px solid var(--border-primary) !important;
			border-radius: var(--radius-xl) !important;
		}

		.modal-header {
			background: var(--bg-tertiary) !important;
			border-bottom: 1px solid var(--border-primary) !important;
			border-radius: var(--radius-xl) var(--radius-xl) 0 0 !important;
			padding: var(--space-4) var(--space-5) !important;
			display: flex !important;
			align-items: center !important;
			justify-content: space-between !important;
		}

		.modal-title {
			color: var(--text-primary) !important;
			font-weight: 700 !important;
			display: flex !important;
			align-items: center !important;
			gap: var(--space-2) !important;
			margin: 0 !important;
			flex: 1 !important;
		}

		.modal-body {
			padding: var(--space-4) var(--space-5) !important;
			max-height: 40vh;
			overflow-y: auto;
			background: var(--bg-secondary) !important;
		}

		.modal-footer {
			background: var(--bg-tertiary) !important;
			border-top: 1px solid var(--border-primary) !important;
			border-radius: 0 0 var(--radius-xl) var(--radius-xl) !important;
			padding: var(--space-4) var(--space-5) !important;
			display: flex !important;
			justify-content: flex-end !important;
			gap: var(--space-3) !important;
		}

		.modal-header .close {
			color: var(--text-secondary) !important;
			opacity: 1 !important;
			font-size: 1.5rem !important;
			background: var(--bg-primary) !important;
			border: 1px solid var(--border-primary) !important;
			border-radius: var(--radius-md) !important;
			width: 36px !important;
			height: 36px !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			padding: 0 !important;
			margin: 0 !important;
			transition: all 0.2s ease !important;
			float: none !important;
			line-height: 1 !important;
		}

		.modal-header .close:hover {
			background: var(--bg-tertiary) !important;
			border-color: var(--success) !important;
			color: var(--success) !important;
		}

		/* Empty state in modal */
		.modal .cart-empty {
			padding: var(--space-6) !important;
		}

		.modal .cart-empty i {
			font-size: 2.5rem !important;
			color: var(--text-tertiary) !important;
			opacity: 0.5 !important;
		}

		.modal .cart-empty p {
			color: var(--text-tertiary) !important;
			font-size: 0.9rem !important;
			margin-top: var(--space-3) !important;
		}

		/* Form Styles */
		.premium-form .form-group {
			margin-bottom: var(--space-4);
		}

		.premium-form label {
			display: block;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: var(--space-2);
		}

		.premium-form .form-control {
			background: var(--bg-primary) !important;
			border: 1px solid var(--border-primary) !important;
			border-radius: var(--radius-md) !important;
			color: var(--text-primary) !important;
			padding: var(--space-3) !important;
			transition: all 0.2s ease !important;
		}

		.premium-form .form-control:focus {
			border-color: var(--success) !important;
			box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
		}

		/* Photo Upload */
		.photo-upload-grid {
			display: grid;
			grid-template-columns: repeat(5, 1fr);
			gap: var(--space-3);
		}

		.preview-box {
			width: 100%;
			aspect-ratio: 1;
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			border-radius: var(--radius-lg);
			border: 2px dashed var(--border-primary);
			cursor: pointer;
			position: relative;
			transition: all 0.2s ease;
		}

		.preview-box:hover {
			border-color: var(--success);
		}

		.btn-remove {
			position: absolute;
			top: -8px;
			right: -8px;
			width: 24px;
			height: 24px;
			background: #ef4444;
			color: white;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1rem;
			cursor: pointer;
			box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
		}

		.file-input {
			display: none;
		}

		/* Material Search Section */
		.material-search-section {
			margin-top: var(--space-4);
			padding-top: var(--space-2);
		}

		.material-search-header {
			display: flex;
			align-items: center;
			gap: var(--space-3);
			font-size: 1.1rem;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: var(--space-4);
		}

		.material-search-header i {
			color: var(--success);
			font-size: 1.2rem;
		}

		/* Material Search */
		.material-search {
			display: flex;
			gap: var(--space-3);
			margin-bottom: var(--space-5);
			flex-wrap: wrap;
		}

		.material-search .form-control,
		.material-search select {
			background: var(--bg-primary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-md);
			color: var(--text-primary);
			padding: var(--space-3);
			flex: 1;
			min-width: 150px;
		}

		.material-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
			gap: var(--space-5);
			margin-top: var(--space-4);
		}

		/* Premium Material Card */
		.material-card {
			background: var(--bg-tertiary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-xl);
			overflow: hidden;
			transition: all 0.3s ease;
		}

		.material-card:hover {
			border-color: var(--success);
			transform: translateY(-4px);
			box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
		}

		.material-card-image {
			position: relative;
			width: 100%;
			height: 160px;
			background: var(--bg-primary);
			overflow: hidden;
		}

		.material-card-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform 0.3s ease;
		}

		.material-card:hover .material-card-image img {
			transform: scale(1.05);
		}

		.material-card-placeholder {
			width: 100%;
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
			background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
		}

		.material-card-placeholder i {
			font-size: 3rem;
			color: var(--text-tertiary);
			opacity: 0.5;
		}

		.material-card-badge {
			position: absolute;
			top: var(--space-3);
			left: var(--space-3);
			background: rgba(0, 0, 0, 0.7);
			backdrop-filter: blur(4px);
			padding: var(--space-1) var(--space-3);
			border-radius: var(--radius-full);
			font-size: 0.7rem;
			color: var(--text-secondary);
			font-family: 'Courier New', monospace;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.material-card-body {
			padding: var(--space-4);
		}

		.material-card-title {
			font-size: 1rem;
			font-weight: 700;
			color: var(--text-primary);
			margin-bottom: var(--space-2);
			line-height: 1.3;
		}

		.material-card-price {
			font-size: 1.125rem;
			font-weight: 700;
			color: var(--success);
			margin-bottom: var(--space-3);
		}

		.material-card-unit {
			font-size: 0.8rem;
			font-weight: 400;
			color: var(--text-tertiary);
		}

		.material-card-desc {
			font-size: 0.8rem;
			color: var(--text-secondary);
			margin-bottom: var(--space-4);
			line-height: 1.5;
		}

		.material-card-qty {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: var(--space-3);
		}

		.material-card-qty label {
			font-size: 0.85rem;
			color: var(--text-secondary);
			font-weight: 500;
		}

		.qty-input-group {
			display: flex;
			align-items: center;
			background: var(--bg-primary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-md);
			overflow: hidden;
		}

		.qty-btn {
			width: 36px;
			height: 36px;
			border: none;
			background: transparent;
			color: var(--text-secondary);
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: all 0.2s ease;
		}

		.qty-btn:hover {
			background: var(--bg-tertiary);
			color: var(--success);
		}

		.qty-input {
			width: 50px;
			height: 36px;
			border: none;
			background: transparent;
			color: var(--text-primary);
			text-align: center;
			font-size: 0.95rem;
			font-weight: 600;
			-moz-appearance: textfield;
		}

		.qty-input::-webkit-outer-spin-button,
		.qty-input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		.material-card-btn {
			width: 100%;
			padding: var(--space-3) var(--space-4);
			background: var(--gradient-primary);
			border: none;
			color: white;
			font-size: 0.9rem;
			font-weight: 600;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: var(--space-2);
			transition: all 0.3s ease;
		}

		.material-card-btn:hover {
			filter: brightness(1.1);
			box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
		}

		.material-card-btn i {
			font-size: 1rem;
		}

		/* Cost Modification Form */
		.cost-form {
			background: var(--bg-tertiary);
			border-radius: var(--radius-lg);
			padding: var(--space-4);
			margin-top: var(--space-4);
			display: flex;
			align-items: center;
			gap: var(--space-4);
			flex-wrap: wrap;
		}

		.cost-form label {
			color: var(--text-primary);
			font-weight: 500;
		}

		.cost-form .form-control {
			background: var(--bg-primary);
			border: 1px solid var(--border-primary);
			border-radius: var(--radius-md);
			color: var(--text-primary);
			padding: var(--space-2) var(--space-3);
			width: 200px;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.detail-grid {
				grid-template-columns: 1fr;
			}

			.photo-upload-grid {
				grid-template-columns: repeat(3, 1fr);
			}

			.provider-avatar {
				width: 100px;
				height: 100px;
			}
		}
	</style>

	<div class="container order-detail-page">
		{{-- Flash messages are handled in app.blade.php --}}

		{{-- Back Button --}}
		<a href="{{ url('/riwayatpemesanan?kategori=all&katakunci=') }}" class="btn-back">
			<i class="fas fa-arrow-left"></i>
			Kembali ke Riwayat Pemesanan
		</a>

		{{-- Order Header --}}
		<div class="order-header">
			<div class="order-number">
				<div style="display: flex; align-items: center; gap: var(--space-3);">
					<span style="color: var(--text-tertiary);">Pemesanan</span>
					<span class="order-number-badge">{{ $value->nomorpemesanan }}</span>
				</div>
				@if($statuspemesanan == '0')
					<span class="status-badge status-menunggu"><i class="fas fa-clock"></i> Menunggu Konfirmasi</span>
				@elseif($statuspemesanan == '1')
					<span class="status-badge status-diterima"><i class="fas fa-check"></i> Diterima</span>
				@elseif($statuspemesanan == '2')
					<span class="status-badge status-ditolak"><i class="fas fa-times"></i> Ditolak</span>
				@elseif($statuspemesanan == '3')
					<span class="status-badge status-dikerjakan"><i class="fas fa-hammer"></i> Dikerjakan</span>
				@elseif($statuspemesanan == '4')
					<span class="status-badge status-selesai"><i class="fas fa-check-double"></i> Selesai</span>
				@endif
			</div>
		</div>

		{{-- Provider Card - Full Width --}}
		<div class="provider-card">
			<div class="provider-card-header">
				<div class="provider-card-inner">
					<div class="provider-avatar-wrapper">
						<div class="provider-avatar">
							@if($value->fotoprofil && file_exists(public_path('images/fotoprofil/' . $value->fotoprofil)))
								<img src="{{ asset('images/fotoprofil/' . $value->fotoprofil) }}" alt="Provider Photo">
							@else
								<div class="provider-avatar-placeholder">
									<i class="fas fa-user"></i>
								</div>
							@endif
						</div>
						<div class="provider-verified-badge" title="Terverifikasi">
							<i class="fas fa-check"></i>
						</div>
					</div>

					<div class="provider-details">
						@if(Auth::user()->statuspengguna == '2')
							{{-- Tukang sees Pelanggan info --}}
							<div class="provider-code">{{ $value->kodeuser ?? 'USER' }}</div>
							<div class="provider-name">{{ $value->namapelanggan }}</div>
							<div class="provider-location">
								<i class="fas fa-map-marker-alt"></i>
								<span>{{ $value->alamat ?? 'Alamat tidak tersedia' }}</span>
							</div>
						@else
							{{-- Pelanggan sees Tukang info --}}
							<a href="{{ url('caritukang/' . $value->id_tukang . '/rincianbiaya') }}" class="provider-code"
								style="text-decoration: none;">{{ $value->kodeuser }}</a>
							<div class="provider-name">{{ $value->namatukang }}</div>

							<div class="rating-stars" style="justify-content: flex-start; margin: var(--space-2) 0;">
								@php
									$rating = $value->ratingtukang ?? 0;
									$rating = round($rating);
								@endphp
								@for($i = 1; $i <= 5; $i++)
									<i class="fas fa-star {{ $i <= $rating ? '' : 'empty' }}"></i>
								@endfor
								@if($value->jumlahvotetukang)
									<span class="rating-text">({{ $value->jumlahvotetukang }} ulasan)</span>
								@endif
							</div>

							<div class="provider-location">
								<i class="fas fa-map-marker-alt"></i>
								<span>{{ $value->alamat ?? 'Alamat tidak tersedia' }}</span>
							</div>

							<div class="provider-category">
								<i class="fas fa-tools"></i>
								<span>{{ $value->kategoritukang }}</span>
							</div>
						@endif
					</div>

					<div class="provider-action">
					@if(count($laporanprogress) > 0 || Auth::user()->statuspengguna == '2')
						<button type="button" class="btn-premium btn-premium-primary" data-toggle="modal"
							data-target="#progressModal" onclick="$('#progressModal').addClass('show in')">
							<i class="fas fa-chart-line"></i> Tracking Progress
						</button>
					@endif

					@if(Auth::user()->statuspengguna == '1' && $statuspemesanan == '4')
						<button type="button" class="btn-premium btn-premium-warning" style="margin-top: var(--space-3); width: 100%;"
							data-toggle="modal" data-target="#ratingModal" onclick="$('#ratingModal').addClass('show in')">
							<i class="fas fa-star"></i> Berikan Rating
						</button>
					@endif

					@if(Auth::user()->statuspengguna == '1' && $statuspemesanan == '3' && $value->tanggalbekerja >= date('Y-m-d'))
						<form action="{{ url('riwayatpemesanan/' . $idpemesanan . '/selesaidikerjakan') }}" method="POST"
							style="margin-top: var(--space-3);">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="biayajasa" value="{{ $value->biayajasa }}">
							<button type="submit" class="btn-premium btn-premium-primary" style="width: 100%;">
								<i class="fas fa-check-circle"></i> Selesai Dikerjakan
							</button>
						</form>
					@endif
				</div>
			</div>
		</div>

		{{-- Order Details Card - Full Width --}}
		<div class="detail-card">
			<div class="detail-card-title">
				<i class="fas fa-clipboard-list"></i>
				<span>Detail Pemesanan</span>
			</div>

			<div class="detail-grid">
				<div class="detail-item">
					<div class="detail-item-icon"><i class="fas fa-calendar-alt"></i></div>
					<div class="detail-item-content">
						<div class="detail-item-label">Tanggal Kedatangan</div>
						<div class="detail-item-value">
							{{ \Carbon\Carbon::parse($value->tanggalbekerja)->format('d F Y') }}
						</div>
					</div>
				</div>

				@if($value->kategoripemesanan == '1')
					<div class="detail-item">
						<div class="detail-item-icon"><i class="fas fa-calendar-check"></i></div>
						<div class="detail-item-content">
							<div class="detail-item-label">Tanggal Selesai</div>
							<div class="detail-item-value">
								{{ \Carbon\Carbon::parse($value->tanggalselesai)->format('d F Y') }}
							</div>
						</div>
					</div>
				@endif

				<div class="detail-item">
					<div class="detail-item-icon"><i class="fas fa-map-marker-alt"></i></div>
					<div class="detail-item-content">
						<div class="detail-item-label">Alamat Pengerjaan</div>
						<div class="detail-item-value">
							{{ $value->alamatpemesanan }}
							<a href="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/lihatpeta') }}"
								style="display: inline-block; margin-left: var(--space-2);">
								<i class="fas fa-map-marked-alt"></i> Lihat Peta
							</a>
						</div>
					</div>
				</div>

				<div class="detail-item">
					<div class="detail-item-icon"><i class="fas fa-clock"></i></div>
					<div class="detail-item-content">
						<div class="detail-item-label">Jenis Pemesanan</div>
						<div class="detail-item-value">
							@if($value->kategoripemesanan == '0')
								<span style="color: var(--success);">Harian</span>
							@else
								<span style="color: #3b82f6;">Borongan</span>
							@endif
						</div>
					</div>
				</div>

				<div class="detail-item">
					<div class="detail-item-icon"><i class="fas fa-tools"></i></div>
					<div class="detail-item-content">
						<div class="detail-item-label">Jasa Yang Dipilih</div>
						<div class="detail-item-value">{{ $value->jenispemesanan }}</div>
					</div>
				</div>
			</div>

			{{-- Price Summary --}}
			<div class="price-card">
				<div class="price-row">
					<span class="price-label">Biaya Jasa {{ $value->jenispemesanan }}</span>
					<span class="price-value">Rp {{ number_format($value->biayajasa, 0, ',', '.') }}</span>
				</div>
				@if($value->statuspemesanan != '0' && $value->statuspemesanan != '2')
					<div class="price-row">
						<span class="price-label">Biaya Pengantaran ({{ number_format($jarak, 1) }} Km × Rp
							{{ number_format($hargajarak->hargajarak, 0, ',', '.') }})</span>
						<span class="price-value">Rp
							{{ number_format($jarak * $hargajarak->hargajarak, 0, ',', '.') }}</span>
					</div>
				@endif
			</div>

			{{-- Notes --}}
			@if($value->catatan)
				<div class="notes-card">
					<div class="notes-label"><i class="fas fa-sticky-note"></i> Catatan</div>
					<div class="notes-content">{{ $value->catatan }}</div>
				</div>
			@endif

			{{-- Rejection Reason --}}
			@if($statuspemesanan == '2' && $value->alasanpenolakanpemesanan)
				<div class="rejection-card">
					<div class="notes-label"><i class="fas fa-exclamation-triangle"></i> Alasan Penolakan</div>
					<div class="notes-content">{{ $value->alasanpenolakanpemesanan }}</div>
				</div>
			@endif
		</div>

		{{-- Cost Modification Form (for Tukang) --}}
		@if(Auth::user()->statuspengguna == '2' && $value->statuspemesanan == '3' && $value->statusubahharga == '0')
			<div class="detail-card">
				<div class="detail-card-title">
					<i class="fas fa-edit"></i>
					<span>Izinkan Ubah Biaya</span>
				</div>
				<form action="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/izinkan') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<p style="color: var(--text-secondary); margin-bottom: var(--space-4);">Klik tombol di bawah untuk
						mengizinkan perubahan biaya jasa.</p>
					<button type="submit" class="btn-premium btn-premium-primary">
						<i class="fas fa-check"></i> Izinkan
					</button>
				</form>
			</div>
		@endif

		{{-- Cost Modification Form (for Pelanggan) --}}
		@if(Auth::user()->statuspengguna == '1' && $value->statuspemesanan == '3' && $value->statusubahharga == '1')
			<div class="detail-card">
				<div class="detail-card-title">
					<i class="fas fa-coins"></i>
					<span>Ubah Biaya Jasa</span>
				</div>
				<form action="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/ubahbiaya') }}" method="POST"
					class="cost-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<label>Biaya Jasa Baru:</label>
					<input type="number" min="{{ $value->biayajasa }}" class="form-control" name="biayajasaubah"
						value="{{ $value->biayajasa }}">
					<button type="submit" class="btn-premium btn-premium-primary">
						<i class="fas fa-save"></i> Simpan
					</button>
				</form>
			</div>
		@endif

		{{-- Material Cart --}}
		<div class="cart-card">
			<div class="detail-card-title">
				<i class="fas fa-shopping-cart"></i>
				<span>Keranjang Bahan Material</span>
				@if(count($pemesananbahan) > 0)
					<span style="margin-left: auto; background: var(--gradient-primary); padding: 4px 12px; border-radius: var(--radius-full); font-size: 0.8rem; color: white;">
						{{ count($pemesananbahan) }} item
					</span>
				@endif
			</div>

			@if(count($pemesananbahan) == 0)
				<div class="cart-empty">
					<i class="fas fa-box-open"></i>
					<p>Belum ada bahan material dalam keranjang</p>
					<p style="font-size: 0.8rem; margin-top: var(--space-2); opacity: 0.7;">Tambah bahan material untuk memudahkan pengerjaan</p>
				</div>
			@else
				@php 
					$i = 1; 
					$subtotal = 0;
				@endphp
				@foreach($pemesananbahan as $bahan)
					@php
						$itemTotal = $bahan->hargapemesananbahanmaterial * $bahan->qtypembelian;
						if($bahan->statuspembelian != '1') {
							$subtotal += $itemTotal;
						}
					@endphp
					<div class="cart-item">
						{{-- Product Image --}}
						@if($bahan->fotobahanmaterial && file_exists(public_path('images/bahanmaterial/' . $bahan->fotobahanmaterial)))
							<img src="{{ asset('images/bahanmaterial/' . $bahan->fotobahanmaterial) }}" alt="{{ $bahan->bahanmaterial }}" class="cart-item-image">
						@else
							<div class="cart-item-image" style="display: flex; align-items: center; justify-content: center; background: var(--bg-primary);">
								<i class="fas fa-cube" style="color: var(--text-tertiary); font-size: 1.5rem;"></i>
							</div>
						@endif

						<div class="cart-item-info">
							<div class="cart-item-code">#{{ $bahan->kodebahanmaterial }}</div>
							<div class="cart-item-name">{{ $bahan->bahanmaterial }}</div>
							<div class="cart-item-price">
								Rp {{ number_format($bahan->hargapemesananbahanmaterial, 0, ',', '.') }}
								<span style="color: var(--text-tertiary); font-weight: 400;">/ unit</span>
							</div>
						</div>

						<div class="cart-item-qty">×{{ $bahan->qtypembelian }}</div>

						{{-- Status Badge --}}
						@if($bahan->statuspembelian == '1')
							<span class="cart-item-status purchased">
								<i class="fas fa-check" style="margin-right: 4px;"></i> Dibeli
							</span>
						@else
							<span class="cart-item-status pending">
								<i class="fas fa-clock" style="margin-right: 4px;"></i> Pending
							</span>
						@endif

						@if(Auth::user()->statuspengguna == '1' && $bahan->statuspembelian != '1')
							<div class="cart-item-actions">
								<a href="{{ url('riwayatpemesanan/' . $idpemesanan . '/' . $bahan->id_pemesananbahanmaterial . '/hapus') }}" title="Hapus dari keranjang">
									<i class="fas fa-trash"></i>
								</a>
							</div>
						@endif
					</div>
					@php $i++; @endphp
				@endforeach

				{{-- Cart Summary --}}
				@if($totalkeranjang > 0)
					<div class="cart-summary">
						<span class="cart-summary-label">
							<i class="fas fa-receipt" style="margin-right: var(--space-2);"></i>
							Subtotal Bahan Material
						</span>
						<span class="cart-summary-value">Rp {{ number_format($totalkeranjang, 0, ',', '.') }}</span>
					</div>
				@endif
			@endif

			{{-- Material Search (for Pelanggan only when order is active) --}}
			@if(Auth::user()->statuspengguna == '1' && ($statuspemesanan == '1' || $statuspemesanan == '3'))
				<div class="material-search-section" style="padding: var(--space-5);">
					<div class="material-search-header">
						<i class="fas fa-plus-circle"></i>
						<span>Pilih Bahan Material</span>
					</div>

					<form action="" method="GET" class="material-search">
						<select class="form-control" name="kategori">
							<option value="all" {{ isset($_GET['kategori']) && $_GET['kategori'] == 'all' ? 'selected' : '' }}>
								Seluruh Kategori</option>
							@foreach($kategoritukang as $kat)
								<option value="{{ $kat->id_kategoritukang }}" {{ isset($_GET['kategori']) && $_GET['kategori'] == $kat->id_kategoritukang ? 'selected' : '' }}>
									{{ $kat->kategoritukang }}
								</option>
							@endforeach
						</select>
						<input type="text" class="form-control" name="katakunci" placeholder="Cari bahan..."
							value="{{ $_GET['katakunci'] ?? '' }}">
						<button type="submit" class="btn-premium btn-premium-primary">
							<i class="fas fa-search"></i> Cari
						</button>
					</form>

					@if(isset($hasilpencarian) && count($hasilpencarian) > 0)
						<div class="material-grid">
							@foreach($hasilpencarian as $material)
								@include('include/kotakbahanmaterial')
							@endforeach
						</div>
					@elseif(isset($hasilpencarian) && count($hasilpencarian) == 0)
						<div class="cart-empty" style="padding: var(--space-6);">
							<i class="fas fa-search"></i>
							<p>Tidak ada bahan material ditemukan</p>
							<p style="font-size: 0.8rem; margin-top: var(--space-2); opacity: 0.7;">Coba ubah kategori atau kata kunci pencarian</p>
						</div>
					@endif
				</div>

				{{-- Process Button --}}
				<div style="margin-top: var(--space-6); text-align: center;">
					<form action="{{ url('riwayatpemesanan/' . $idpemesanan . '/prosespembelian') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="totalkeranjang" value="{{ $totalkeranjang }}">
						<input type="hidden" name="biayajarak" value="{{ $jarak * $hargajarak->hargajarak }}">
						<button type="submit" class="btn-premium btn-premium-primary">
							<i class="fas fa-check-circle"></i> Proses Pembelian
						</button>
					</form>

					@if($statuspemesanan == '1')
						<p style="color: var(--text-tertiary); font-size: 0.8rem; margin-top: var(--space-3);">
							Jika tidak memerlukan bahan material, kosongkan keranjang dan tekan Proses
						</p>
					@endif
				</div>
			@endif
		</div>
	</div>
	</div>
	</div>

	{{-- Tracking Progress Modal --}}
	<div class="modal fade" id="trackingProgressModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fas fa-chart-line"
							style="margin-right: var(--space-2); color: var(--success);"></i> Tracking Progress Pekerjaan
					</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					@if(Auth::user()->statuspengguna == '2')
						<button class="btn-premium btn-premium-primary" data-toggle="modal" data-target="#modalTambahProgress"
							style="margin-bottom: var(--space-5);">
							<i class="fas fa-plus"></i> Tambah Progress
						</button>
					@endif

					@if(count($laporanprogress) > 0)
						<div class="progress-timeline">
							@foreach($laporanprogress as $progress)
								<div class="progress-item">
									<div class="progress-header">
										<span class="progress-author">{{ $progress->nama_tukang }}</span>
										<span class="progress-date">
											<i class="fas fa-clock"></i>
											{{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('d M Y H:i') }}
										</span>
									</div>
									<div class="progress-content">{{ $progress->informasi_pekerjaan }}</div>

									@php
										$hasPhotos = false;
										for ($i = 1; $i <= 5; $i++) {
											if (!empty($progress->{'fotoprogress' . $i})) {
												$hasPhotos = true;
												break;
											}
										}
									@endphp

									@if($hasPhotos)
										<div class="progress-images">
											@for($i = 1; $i <= 5; $i++)
												@if(!empty($progress->{'fotoprogress' . $i}))
													<img src="{{ asset('storage/' . $progress->{'fotoprogress' . $i}) }}" alt="Progress Photo">
												@endif
											@endfor
										</div>
									@endif

									@if(Auth::user()->statuspengguna == '2')
										<div class="progress-actions">
											<button type="button" class="btn-premium btn-premium-secondary btn-open-edit"
												data-id="{{ $progress->id_progress }}"
												style="padding: var(--space-2) var(--space-3); font-size: 0.8rem;">
												<i class="fas fa-edit"></i> Ubah
											</button>
											<form action="{{ url('progress/' . $progress->id_progress . '/delete') }}" method="POST"
												style="display: inline;" onsubmit="return confirm('Yakin hapus progress ini?')">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="btn-premium btn-premium-secondary"
													style="padding: var(--space-2) var(--space-3); font-size: 0.8rem; color: #ef4444;">
													<i class="fas fa-trash"></i> Hapus
												</button>
											</form>
										</div>
									@endif
								</div>
							@endforeach
						</div>
					@else
						<div class="cart-empty">
							<i class="fas fa-clipboard-list"></i>
							<p>Belum ada progress pekerjaan yang ditambahkan</p>
						</div>
					@endif
				</div>

				<div class="modal-footer">
					<button type="button" class="btn-premium btn-premium-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	{{-- Add Progress Modal (for Tukang) --}}
	@if(Auth::user()->statuspengguna == '2')
		<div class="modal fade" id="modalTambahProgress" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/store') }}" method="POST"
						enctype="multipart/form-data" class="premium-form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id_pemesanan" value="{{ $idpemesanan }}">

						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-plus-circle"
									style="margin-right: var(--space-2); color: var(--success);"></i> Tambah Progress</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<div class="form-group">
								<label>Tanggal <span style="color: #ef4444;">*</span></label>
								<input type="datetime-local" name="tanggal_progress" class="form-control" required>
							</div>

							<div class="form-group">
								<label>Isi Kegiatan <span style="color: #ef4444;">*</span></label>
								<textarea name="informasi_pekerjaan" class="form-control" rows="4"
									placeholder="Deskripsikan progress pekerjaan..." required></textarea>
							</div>

							<div class="form-group">
								<label>Foto Progress <span style="color: #ef4444;">*</span></label>
								<div class="photo-upload-grid">
									@for($i = 1; $i <= 5; $i++)
										<div>
											<div id="imagePreview_0_{{ $i }}" class="preview-box"
												style="background-image: url('{{ asset('images/frontslider/addpicture.png') }}')"
												onclick="document.getElementById('uploadFile_0_{{ $i }}').click()"></div>
											<input type="file" id="uploadFile_0_{{ $i }}" name="fotoprogress{{ $i }}"
												class="file-input" accept="image/*" onchange="previewImage(this, 0, {{ $i }})"
												@if($i == 1) required @endif>
										</div>
									@endfor
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn-premium btn-premium-primary"><i class="fas fa-save"></i>
								Simpan</button>
							<button type="button" class="btn-premium btn-premium-secondary" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		{{-- Edit Progress Modals --}}
		@foreach($laporanprogress as $progress)
			<div class="modal fade" id="modalEditProgress{{ $progress->id_progress }}" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form action="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/update') }}" method="POST"
							enctype="multipart/form-data" class="premium-form">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id_progress" value="{{ $progress->id_progress }}">

							<div class="modal-header">
								<h4 class="modal-title"><i class="fas fa-edit"
										style="margin-right: var(--space-2); color: var(--success);"></i> Ubah Progress</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<div class="modal-body">
								<div class="form-group">
									<label>Tanggal</label>
									<input type="datetime-local" name="tanggal_progress" class="form-control"
										value="{{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('Y-m-d\TH:i') }}"
										required>
								</div>

								<div class="form-group">
									<label>Isi Kegiatan</label>
									<textarea name="informasi_pekerjaan" class="form-control" rows="4"
										required>{{ $progress->informasi_pekerjaan }}</textarea>
								</div>

								<div class="form-group">
									<label>Foto Progress</label>
									<div class="photo-upload-grid">
										@for($i = 1; $i <= 5; $i++)
											<div style="position: relative;">
												<input type="hidden" name="hapus_foto{{ $i }}"
													id="hapus_foto_{{ $progress->id_progress }}_{{ $i }}" value="0">
												<div id="imagePreview_{{ $progress->id_progress }}_{{ $i }}" class="preview-box"
													style="background-image: url('{{ !empty($progress->{'fotoprogress' . $i}) ? asset('storage/' . $progress->{'fotoprogress' . $i}) : asset('images/frontslider/addpicture.png') }}')"
													onclick="document.getElementById('uploadFile_{{ $progress->id_progress }}_{{ $i }}').click()">
													@if($i != 1 && !empty($progress->{'fotoprogress' . $i}))
														<span class="btn-remove"
															onclick="event.stopPropagation(); hapusFotoEdit('{{ $progress->id_progress }}','{{ $i }}')">&times;</span>
													@endif
												</div>
												<input type="file" id="uploadFile_{{ $progress->id_progress }}_{{ $i }}"
													name="fotoprogress{{ $i }}" class="file-input" accept="image/*"
													onchange="previewImage(this, {{ $progress->id_progress }}, {{ $i }})">
											</div>
										@endfor
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn-premium btn-premium-primary"><i class="fas fa-save"></i>
									Simpan</button>
								<button type="button" class="btn-premium btn-premium-secondary" data-dismiss="modal">Batal</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	@endif

	{{-- Progress Modal --}}
	<div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="progressModalLabel">
						<i class="fas fa-chart-line" style="color: var(--success); margin-right: var(--space-2);"></i>
						Tracking Progress
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"
						onclick="$('#progressModal').removeClass('show in');">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					@if(count($laporanprogress) > 0)
						<div class="progress-timeline">
							@foreach($laporanprogress as $progress)
								<div class="progress-item">
									<div class="progress-header">
										<span class="progress-author">
											<i class="fas fa-user-hard-hat" style="margin-right: var(--space-1);"></i>
											Laporan Progress
										</span>
										<span class="progress-date">
											{{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('d M Y, H:i') }}
										</span>
									</div>
									<div class="progress-content">
										{{ $progress->informasi_pekerjaan }}
									</div>
									@php
										$progressPhotos = [];
										if ($progress->fotoprogress1)
											$progressPhotos[] = $progress->fotoprogress1;
										if ($progress->fotoprogress2)
											$progressPhotos[] = $progress->fotoprogress2;
										if ($progress->fotoprogress3)
											$progressPhotos[] = $progress->fotoprogress3;
										if ($progress->fotoprogress4)
											$progressPhotos[] = $progress->fotoprogress4;
										if ($progress->fotoprogress5)
											$progressPhotos[] = $progress->fotoprogress5;
									@endphp
									@if(count($progressPhotos) > 0)
										<div class="progress-images">
											@foreach($progressPhotos as $photo)
												<a href="{{ asset('images/fotoprogress/' . $photo) }}" target="_blank">
													<img src="{{ asset('images/fotoprogress/' . $photo) }}" alt="Progress Photo">
												</a>
											@endforeach
										</div>
									@endif
								</div>
							@endforeach
						</div>
					@else
						<div class="cart-empty">
							<i class="fas fa-clipboard-list"></i>
							<p>Belum ada laporan progress untuk pesanan ini.</p>
						</div>
					@endif
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-premium btn-premium-secondary" data-dismiss="modal"
						onclick="$('#progressModal').removeClass('show in');">
						<i class="fas fa-times"></i> Tutup
					</button>
				</div>
			</div>
		</div>
	</div>

	{{-- Rating Modal --}}
	@if(Auth::user()->statuspengguna == '1' && $statuspemesanan == '4')
	<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form action="{{ url('riwayatpemesanan/' . $idpemesanan . '/berikan-rating') }}" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="ratingModalLabel">
							<i class="fas fa-star" style="color: #fbbf24; margin-right: var(--space-2);"></i>
							Berikan Rating
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"
							onclick="$('#ratingModal').removeClass('show in');">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="rating-tukang-info" style="display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-5); padding: var(--space-4); background: var(--bg-tertiary); border-radius: var(--radius-lg);">
							<div style="width: 50px; height: 50px; border-radius: 50%; background: var(--bg-primary); display: flex; align-items: center; justify-content: center; border: 2px solid var(--success);">
								@if($value->fotoprofil && file_exists(public_path('images/fotoprofil/' . $value->fotoprofil)))
									<img src="{{ asset('images/fotoprofil/' . $value->fotoprofil) }}" alt="Tukang" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
								@else
									<i class="fas fa-user" style="color: var(--text-tertiary);"></i>
								@endif
							</div>
							<div>
								<div style="font-weight: 600; color: var(--text-primary);">{{ $value->namatukang }}</div>
								<div style="font-size: 0.85rem; color: var(--text-tertiary);">{{ $value->kategoritukang }}</div>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: var(--space-5);">
							<label style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: var(--space-3);">
								<i class="fas fa-star" style="color: #fbbf24; margin-right: var(--space-2);"></i>
								Rating Anda
							</label>
							<div class="star-rating-input">
								@for($i = 5; $i >= 1; $i--)
								<input type="radio" name="nilairating" value="{{ $i }}" id="star{{ $i }}" {{ $i == 5 ? 'checked' : '' }} required>
								<label for="star{{ $i }}"><i class="fas fa-star"></i></label>
								@endfor
							</div>
						</div>

						<div class="form-group">
							<label style="display: block; font-weight: 600; color: var(--text-primary); margin-bottom: var(--space-2);">
								<i class="fas fa-comment" style="color: var(--success); margin-right: var(--space-2);"></i>
								Ulasan Anda
							</label>
							<textarea class="form-control" name="isiulasan" rows="4" 
								placeholder="Bagikan pengalaman Anda dengan tukang ini..." required
								style="background: var(--bg-tertiary); border: 1px solid var(--border-primary); border-radius: var(--radius-md); color: var(--text-primary); padding: var(--space-3); width: 100%; resize: vertical;"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-premium btn-premium-secondary" data-dismiss="modal"
							onclick="$('#ratingModal').removeClass('show in');">
							<i class="fas fa-times"></i> Batal
						</button>
						<button type="submit" class="btn-premium btn-premium-primary">
							<i class="fas fa-paper-plane"></i> Kirim Rating
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<style>
		/* Star Rating Input */
		.star-rating-input {
			display: flex;
			flex-direction: row-reverse;
			justify-content: flex-end;
			gap: var(--space-1);
		}
		.star-rating-input input {
			display: none;
		}
		.star-rating-input label {
			cursor: pointer;
			font-size: 2rem;
			color: var(--border-primary);
			transition: color 0.2s ease;
		}
		.star-rating-input input:checked ~ label,
		.star-rating-input label:hover,
		.star-rating-input label:hover ~ label {
			color: #fbbf24;
		}

		/* Warning Button */
		.btn-premium-warning {
			background: linear-gradient(135deg, #fbbf24, #f59e0b);
			color: #1a1a1a;
		}
		.btn-premium-warning:hover {
			filter: brightness(1.1);
			box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
		}
	</style>
	@endif

@endsection

@section('scripts')
	<script>
		function previewImage(input, progressId, index) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					document.getElementById('imagePreview_' + progressId + '_' + index).style.backgroundImage = 'url(' + e.target.result + ')';
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		function hapusFotoEdit(progressId, index) {
			document.getElementById('hapus_foto_' + progressId + '_' + index).value = '1';
			document.getElementById('imagePreview_' + progressId + '_' + index).style.backgroundImage = "url('{{ asset('images/frontslider/addpicture.png') }}')";
			var closeBtn = document.getElementById('close_' + progressId + '_' + index);
			if (closeBtn) closeBtn.style.display = 'none';
		}

		// Open edit modal
		document.querySelectorAll('.btn-open-edit').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var id = this.getAttribute('data-id');
				$('#modalEditProgress' + id).modal('show');
			});
		});
	</script>
@endsection