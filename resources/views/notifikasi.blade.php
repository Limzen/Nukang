@extends('app')

@section('title', 'Notifikasi - Nukang')

@section('content')
    <div class="notification-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header animate-fadeIn">
                <div class="header-icon">
                    <i class="fas fa-bell"></i>
                    @if(count($notifunread) > 0)
                        <span class="badge">{{ count($notifunread) }}</span>
                    @endif
                </div>
                <div class="header-text">
                    <h1>Notifikasi</h1>
                    <p>Pantau semua aktivitas akun Anda</p>
                </div>
            </div>

            {{-- Notification Tabs --}}
            <div class="notif-tabs animate-fadeIn">
                <button class="tab-btn active" data-tab="unread">
                    <i class="fas fa-envelope"></i>
                    Belum Dibaca
                    @if(count($notifunread) > 0)
                        <span class="tab-badge">{{ count($notifunread) }}</span>
                    @endif
                </button>
                <button class="tab-btn" data-tab="read">
                    <i class="fas fa-envelope-open"></i>
                    Sudah Dibaca
                </button>
            </div>

            {{-- Unread Notifications --}}
            <div class="tab-content active" id="unread">
                @if(count($notifunread) > 0)
                    <div class="notif-list">
                        @foreach($notifunread as $key => $value)
                            <div class="notif-card notif-unread animate-fadeIn" style="animation-delay: {{ $key * 0.05 }}s">
                                <div class="notif-indicator"></div>
                                <div class="notif-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notif-content">
                                    <p class="notif-text">
                                        <span class="notif-user">User {{ $value->kodeuser }}</span>
                                        {{ $value->isinotifikasi }}
                                    </p>
                                    <span class="notif-time">
                                        <i class="fas fa-clock"></i> {{ $value->tanggalnotifikasi }}
                                    </span>
                                </div>
                                <div class="notif-actions">
                                    <a href="{{ url($value->jenisnotifikasi) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ url('notifikasi') }}/{{ $value->id_notifikasi }}/markasread"
                                        class="btn btn-ghost btn-sm">
                                        <i class="fas fa-check"></i> Tandai Dibaca
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper">
                        {!! $notifunread->render() !!}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-bell-slash"></i>
                        </div>
                        <h3>Tidak Ada Notifikasi Baru</h3>
                        <p>Semua notifikasi sudah Anda baca</p>
                    </div>
                @endif
            </div>

            {{-- Read Notifications --}}
            <div class="tab-content" id="read">
                @if(count($notifread) > 0)
                    <div class="notif-list">
                        @foreach($notifread as $key => $value)
                            <div class="notif-card animate-fadeIn" style="animation-delay: {{ $key * 0.05 }}s">
                                <div class="notif-icon notif-icon-read">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="notif-content">
                                    <p class="notif-text">
                                        <span class="notif-user">User {{ $value->kodeuser }}</span>
                                        {{ $value->isinotifikasi }}
                                    </p>
                                    <span class="notif-time">
                                        <i class="fas fa-clock"></i> {{ $value->tanggalnotifikasi }}
                                    </span>
                                </div>
                                <div class="notif-actions">
                                    <a href="{{ url($value->jenisnotifikasi) }}" class="btn btn-ghost btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper">
                        {!! $notifread->render() !!}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h3>Tidak Ada Riwayat</h3>
                        <p>Belum ada notifikasi yang sudah dibaca</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .notification-page {
            padding: var(--space-6) 0 var(--space-16);
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            margin-bottom: var(--space-8);
        }

        .header-icon {
            position: relative;
            width: 64px;
            height: 64px;
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .header-icon .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 24px;
            height: 24px;
            background: var(--danger);
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .header-text h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
        }

        /* Tabs */
        .notif-tabs {
            display: flex;
            gap: var(--space-2);
            margin-bottom: var(--space-6);
            padding: var(--space-2);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
        }

        .tab-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            padding: var(--space-4);
            background: transparent;
            border: none;
            border-radius: var(--radius-lg);
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            color: var(--text-primary);
            background: var(--bg-tertiary);
        }

        .tab-btn.active {
            background: var(--gradient-primary);
            color: white;
        }

        .tab-badge {
            padding: var(--space-1) var(--space-2);
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Notification List */
        .notif-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .notif-card {
            display: flex;
            align-items: flex-start;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            transition: all 0.3s ease;
            position: relative;
        }

        .notif-card:hover {
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateX(8px);
        }

        .notif-unread {
            border-left: 3px solid var(--success);
        }

        .notif-indicator {
            position: absolute;
            top: var(--space-5);
            left: var(--space-3);
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .notif-icon {
            width: 48px;
            height: 48px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .notif-icon-read {
            background: var(--bg-tertiary);
            color: var(--text-tertiary);
        }

        .notif-content {
            flex: 1;
        }

        .notif-text {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: var(--space-2);
        }

        .notif-user {
            font-weight: 600;
            color: var(--success);
        }

        .notif-time {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.8rem;
            color: var(--text-tertiary);
        }

        .notif-actions {
            display: flex;
            gap: var(--space-2);
            flex-shrink: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--space-16);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--bg-tertiary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-6);
            font-size: 2rem;
            color: var(--text-tertiary);
        }

        .empty-state h3 {
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            color: var(--text-secondary);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: var(--space-6);
            display: flex;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .notif-card {
                flex-direction: column;
            }

            .notif-actions {
                width: 100%;
                margin-top: var(--space-3);
            }

            .notif-actions .btn {
                flex: 1;
            }
        }
    </style>

    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                btn.classList.add('active');
                document.getElementById(btn.dataset.tab).classList.add('active');
            });
        });
    </script>
@endsection