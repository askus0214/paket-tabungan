<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - Celengan Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #09090b;
            /* Tema gelap konsisten dengan gambar admin panel */
            color: #f4f4f5;
            margin: 0;
            padding: 0;
            display: flex;
            min-h: 100vh;
        }

        h1,
        h2,
        h3,
        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- LAYOUT SIDEBAR & KONTEN --- */
        .app-container {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 260px;
            background-color: #18181b;
            border-right: 1px solid #27272a;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            height: 100vh;
            box-sizing: border-box;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 48px;
            max-width: 1200px;
            box-sizing: border-box;
        }

        /* --- LOGO & MENU --- */
        .brand-logo {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 40px;
            letter-spacing: -0.5px;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #a1a1aa;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fb923c;
            /* Warna orange aksen emas sesuai tema screenshot */
            background-color: rgba(251, 146, 60, 0.08);
        }

        /* --- HEADER SEKTOR --- */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #27272a;
            padding-bottom: 24px;
            margin-bottom: 40px;
        }

        /* --- CARDS WRAPPER INTERAKTIF --- */
        .card-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: flex-start;
        }

        .custom-card {
            background: #18181b;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid #27272a;
            width: calc(50% - 16px);
            /* Kunci 2 kolom pas kanan-kiri */
            box-sizing: border-box;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            /* Memberikan petunjuk bahwa kartu bisa diklik */
        }

        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.7);
            border-color: #3f3f46;
        }

        /* --- PROGRESS BAR --- */
        .progress-bg {
            background-color: #27272a;
            border-radius: 9999px;
            height: 10px;
            width: 100%;
            overflow: hidden;
            margin-top: 8px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 9999px;
            transition: width 0.7s ease-in-out;
        }

        /* Tombol Keluar / Logout */
        .btn-logout {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            width: 100%;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Custom Scrollbar untuk Tabel Modal */
        .modal-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .modal-scroll::-webkit-scrollbar-track {
            background: #18181b;
        }

        .modal-scroll::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 10px;
        }

        .modal-scroll::-webkit-scrollbar-thumb:hover {
            background: #3f3f46;
        }

        /* Responsif Layar Kecil */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 24px 8px;
                align-items: center;
            }

            .sidebar .nav-text,
            .sidebar .brand-logo,
            .sidebar .btn-text {
                display: none;
            }

            .main-content {
                margin-left: 80px;
                padding: 24px;
            }

            .custom-card {
                width: 100%;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="app-container">

        <aside class="sidebar">
            <div>
                <div class="brand-logo font-jakarta">Paket Lebaranku</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('member.dashboard') }}" class="nav-link active">
                            <span>🏠</span> <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->is_admin ?? true)
                        <li class="nav-item">
                            {{-- <a href="/admin" class="nav-link" style="color: #fb923c;">
                                <span>⚙️</span> <span class="nav-text">Panel Admin</span>
                            </a> --}}
                        </li>
                    @endif
                </ul>
            </div>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <span>🚪</span> <span class="btn-text">Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">

            <div class="header-container">
                <div>
                    <span
                        style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #fb923c; background-color: rgba(251,146,60,0.1); padding: 6px 14px; border-radius: 9999px;">Ruang
                        Member</span>
                    <h1
                        style="font-size: 36px; font-weight: 800; color: #fff; margin: 12px 0 4px 0; tracking-tight: -1px;">
                        Celengan Digital Anda 🚀</h1>
                    <p style="color: #71717a; margin: 0; font-size: 15px;">Pantau capaian dan penuhi target semua
                        program tabungan impianmu.</p>
                </div>

                <div
                    style="display: flex; align-items: center; gap: 16px; background: #18181b; padding: 16px 24px; border-radius: 20px; border: 1px solid #27272a;">
                    <div style="color: #fb923c; font-size: 24px;">📊</div>
                    <div>
                        <span
                            style="display: block; font-size: 10px; font-weight: 700; text-transform: uppercase; color: #71717a; letter-spacing: 0.5px;">Program
                            Diikuti</span>
                        <span class="font-jakarta"
                            style="font-size: 22px; font-weight: 700; color: #fff;">{{ $savings->count() }} Paket</span>
                    </div>
                </div>
            </div>

            <div class="card-wrapper">

                @foreach ($savings as $index => $saving)
                    @php
                        $progress = 0;
                        if ($saving->target_amount > 0) {
                            $progress = ($saving->current_amount / $saving->target_amount) * 100;
                            $progress = $progress > 100 ? 100 : $progress;
                        }
                        $remaining = $saving->target_amount - $saving->current_amount;
                        $remaining = $remaining < 0 ? 0 : $remaining;

                        // Variasi warna gradasi tema gelap premium per kartu
                        $themes = [
                            [
                                'bg' => 'linear-gradient(135deg, #2e1065, #3b82f6)',
                                'text' => '#60a5fa',
                                'bar' => 'linear-gradient(90deg, #3b82f6, #06b6d4)',
                            ],
                            [
                                'bg' => 'linear-gradient(135deg, #4c0519, #e11d48)',
                                'text' => '#fb7185',
                                'bar' => 'linear-gradient(90deg, #e11d48, #f97316)',
                            ],
                            [
                                'bg' => 'linear-gradient(135deg, #064e3b, #10b981)',
                                'text' => '#34d399',
                                'bar' => 'linear-gradient(90deg, #10b981, #f59e0b)',
                            ],
                        ];

                        $currentTheme = $themes[$index % count($themes)];
                    @endphp

                    <div class="custom-card" onclick="openTransactionModal({{ $saving->id }})">
                        <div>
                            <div
                                style="background: {{ $currentTheme['bg'] }}; height: 140px; width: 100%; padding: 24px; box-sizing: border-box; display: flex; align-items: flex-end; position: relative; opacity: 0.85;">
                                <span class="font-jakarta"
                                    style="color: rgba(255,255,255,0.15); font-weight: 800; font-size: 26px; text-transform: uppercase; letter-spacing: 1px;">Saving
                                    Plan</span>
                                <span
                                    style="position: absolute; top: 16px; right: 16px; padding: 4px 14px; border-radius: 9999px; font-size: 11px; font-weight: 700; background: rgba(0,0,0,0.4); color: #fb923c; border: 1px solid rgba(251,146,60,0.3);">
                                    {{ ucfirst($saving->status) }}
                                </span>
                            </div>

                            <div style="padding: 28px;">
                                <h2
                                    style="font-size: 24px; font-weight: 700; color: #fff; margin: 0 0 8px 0; tracking-tight: -0.5px;">
                                    {{ $saving->package->title }}
                                </h2>
                                <p style="color: #71717a; font-size: 14px; margin: 0 0 28px 0; line-height: 1.6;">
                                    {{ $saving->package->description ?? 'Tidak ada deskripsi untuk program tabungan ini.' }}
                                </p>

                                <div
                                    style="background: #202023; padding: 20px; border-radius: 16px; border: 1px solid #27272a; margin-bottom: 24px;">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                                        <span
                                            style="font-size: 11px; font-weight: 700; color: #71717a; text-transform: uppercase; letter-spacing: 0.5px;">Capaian
                                            Progress</span>
                                        <span class="font-jakarta"
                                            style="font-size: 22px; font-weight: 800; color: #fff;">{{ number_format($progress, 0) }}%</span>
                                    </div>
                                    <div class="progress-bg">
                                        <div class="progress-fill"
                                            style="width: {{ $progress }}%; background: {{ $currentTheme['bar'] }};">
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        <span
                                            style="font-size: 10px; font-weight: 700; color: #52525b; text-transform: uppercase; display: block; margin-bottom: 4px;">Terkumpul</span>
                                        <span class="font-jakarta"
                                            style="font-size: 18px; font-weight: 700; color: #e4e4e7;">Rp
                                            {{ number_format($saving->current_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span
                                            style="font-size: 10px; font-weight: 700; color: #52525b; text-transform: uppercase; display: block; margin-bottom: 4px;">Target
                                            Akhir</span>
                                        <span class="font-jakarta"
                                            style="font-size: 18px; font-weight: 700; color: #e4e4e7;">Rp
                                            {{ number_format($saving->target_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="padding: 0 28px 28px 28px;">
                            <div style="border-top: 1px dashed #27272a; margin-bottom: 20px;"></div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02); padding: 14px 20px; border-radius: 16px; border: 1px solid #27272a;">
                                <span
                                    style="font-size: 12px; font-weight: 700; color: #71717a; text-transform: uppercase;">Sisa
                                    Kekurangan</span>
                                <span class="font-jakarta"
                                    style="font-size: 16px; font-weight: 800; color: {{ $currentTheme['text'] }};">
                                    @if ($remaining == 0)
                                        <span
                                            style="color: #34d399; font-size: 13px; font-weight: 700; background: rgba(52,211,153,0.1); padding: 4px 12px; border-radius: 8px;">LUNAS
                                            🎉</span>
                                    @else
                                        Rp {{ number_format($remaining, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </main>
    </div>

    <div id="transactionModal"
        style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(9, 9, 11, 0.8); align-items: center; justify-content: center; backdrop-filter: blur(8px); transition: all 0.3s;">
        <div
            style="background-color: #18181b; border: 1px solid #27272a; border-radius: 24px; width: 90%; max-width: 600px; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7); position: relative; color: #f4f4f5; box-sizing: border-box;">

            <button onclick="closeTransactionModal()"
                style="position: absolute; right: 24px; top: 24px; background: #27272a; border: none; color: #a1a1aa; font-size: 18px; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                onmouseover="this.style.color='#fff'; this.style.background='#3f3f46'"
                onmouseout="this.style.color='#a1a1aa'; this.style.background='#27272a'">&times;</button>

            <div style="margin-bottom: 24px;">
                <span
                    style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #fb923c;">Riwayat
                    Mutasi</span>
                <h3 id="modalSavingName"
                    style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 22px; font-weight: 700; color: #fff; margin: 6px 0 4px 0;">
                    Detail Transaksi</h3>
                <p style="color: #71717a; margin: 0; font-size: 14px;">Daftar aliran uang masuk pada program tabungan
                    ini.</p>
            </div>

            <div style="border-top: 1px solid #27272a; margin-bottom: 20px;"></div>

            <div class="modal-scroll"
                style="max-height: 320px; overflow-y: auto; padding-right: 4px; box-sizing: border-box;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: left;">
                    <thead>
                        <tr
                            style="border-bottom: 1px solid #27272a; color: #71717a; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <th style="padding: 12px 8px; font-weight: 600;">Tanggal</th>
                            <th style="padding: 12px 8px; font-weight: 600;">Status</th>
                            <th style="padding: 12px 8px; font-weight: 600; text-align: right;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openTransactionModal(savingId) {
            const modal = document.getElementById('transactionModal');
            const tableBody = document.getElementById('transactionTableBody');
            const modalTitle = document.getElementById('modalSavingName');

            // Tampilkan animasi loading awal
            tableBody.innerHTML =
                '<tr><td colspan="3" style="text-align:center; padding:32px; color:#71717a;"><span style="display:block; margin-bottom:8px; font-size:20px;">⏳</span>Sedang memuat riwayat transaksi...</td></tr>';
            modal.style.display = 'flex';

            // Menembak data real-time ke Endpoint Laravel Controller
            fetch(`/member/savings/${savingId}/transactions`)
                .then(response => response.json())
                .then(data => {
                    modalTitle.innerText = data.saving_name;
                    tableBody.innerHTML = '';

                    // Jika tidak ditemukan transaksi sama sekali
                    if (!data.transactions || data.transactions.length === 0) {
                        tableBody.innerHTML =
                            '<tr><td colspan="3" style="text-align:center; padding:40px; color:#71717a;"><span style="display:block; margin-bottom:8px; font-size:24px;">📭</span>Belum ada catatan transaksi masuk.</td></tr>';
                        return;
                    }

                    // Looping baris data transaksi ke dalam tabel pop-up
                    data.transactions.forEach(tx => {
                        const date = new Date(tx.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        });

                        // Format mata uang Rupiah
                        const amount = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(tx.amount);

                        // Menyesuaikan jika ada tipe pengeluaran/penarikan, jika hanya setoran bawaan warna success (hijau)
                        const isDeposit = tx.type !== 'withdrawal';
                        const badgeColor = isDeposit ? '#34d399' : '#f87171';
                        const badgeText = isDeposit ? 'Masuk' : 'Keluar';

                        tableBody.innerHTML += `
                            <tr style="border-bottom: 1px solid #202023; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 14px 8px; color: #e4e4e7;">${date}</td>
                                <td style="padding: 14px 8px;">
                                    <span style="color: ${badgeColor}; background: ${badgeColor}15; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: 1px solid ${badgeColor}25;">
                                        ${badgeText}
                                    </span>
                                </td>
                                <td style="padding: 14px 8px; text-align: right; color: #fff; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;">${amount}</td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    tableBody.innerHTML =
                        '<tr><td colspan="3" style="text-align:center; padding:32px; color:#ef4444;"><span style="display:block; margin-bottom:8px; font-size:20px;">⚠️</span>Gagal mengambil data transaksi. Silakan coba lagi.</td></tr>';
                });
        }

        function closeTransactionModal() {
            document.getElementById('transactionModal').style.display = 'none';
        }

        // Auto close jika area hitam blur di luar kotak putih di-klik
        window.onclick = function(event) {
            const modal = document.getElementById('transactionModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>

</html>
