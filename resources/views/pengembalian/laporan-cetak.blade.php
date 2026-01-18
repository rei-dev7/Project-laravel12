<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            padding: 40px;
            background: white;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #4F46E5;
        }
        
        .header h1 {
            font-size: 28px;
            color: #4F46E5;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #666;
            font-size: 14px;
        }
        
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 13px;
            color: #666;
        }
        
        .transaksi-card {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            margin-bottom: 30px;
            overflow: hidden;
            page-break-inside: avoid;
        }
        
        .transaksi-header {
            background: #F3F4F6;
            padding: 15px 20px;
            border-bottom: 2px solid #E5E7EB;
        }
        
        .transaksi-header-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        
        .transaksi-info {
            margin-bottom: 8px;
        }
        
        .info-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #6B7280;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 14px;
            font-weight: bold;
            color: #1F2937;
        }
        
        .kondisi-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .kondisi-baik {
            background: #D1FAE5;
            color: #065F46;
        }
        
        .kondisi-rusak {
            background: #FEF3C7;
            color: #92400E;
        }
        
        .kondisi-hilang {
            background: #FEE2E2;
            color: #991B1B;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #F9FAFB;
        }
        
        th {
            padding: 12px 20px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        th.text-center {
            text-align: center;
        }
        
        td {
            padding: 12px 20px;
            border-bottom: 1px solid #F3F4F6;
            font-size: 13px;
        }
        
        td.text-center {
            text-align: center;
            font-weight: bold;
            color: #4F46E5;
        }
        
        .catatan-row {
            background: #FFFBEB;
            border-top: 2px dashed #F59E0B;
        }
        
        .catatan-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #92400E;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .catatan-text {
            font-style: italic;
            color: #78350F;
            font-size: 13px;
        }
        
        .summary {
            background: #F9FAFB;
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .summary-item {
            text-align: center;
        }
        
        .summary-value {
            font-size: 32px;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 60px;
            text-align: right;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }
        
        .signature-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 80px;
        }
        
        .signature-line {
            border-top: 2px solid #000;
            padding-top: 5px;
            font-weight: bold;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4F46E5;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .print-button:hover {
            background: #4338CA;
        }
        
        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #9CA3AF;
            font-size: 16px;
        }
        
        @media print {
            body {
                padding: 20px;
            }
            
            .print-button {
                display: none;
            }
            
            @page {
                margin: 2cm;
                size: A4;
            }
            
            .transaksi-card {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">
        🖨️ Cetak Laporan
    </button>

    <div class="header">
        <h1>LAPORAN PENGEMBALIAN BARANG</h1>
        <p>Sistem Inventaris Barang</p>
    </div>

    <div class="meta-info">
        <div>
            <strong>Periode:</strong> {{ \Carbon\Carbon::parse($pengembalian->min('tanggal_kembali'))->format('d F Y') }} - 
            {{ \Carbon\Carbon::parse($pengembalian->max('tanggal_kembali'))->format('d F Y') }}
        </div>
        <div>
            <strong>Dicetak:</strong> {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB
        </div>
    </div>

    @forelse($pengembalian as $item)
    <div class="transaksi-card">
        <div class="transaksi-header">
            <div class="transaksi-header-grid">
                <div class="transaksi-info">
                    <div class="info-label">No. Transaksi</div>
                    <div class="info-value">#{{ $item->id_peminjaman }}</div>
                </div>
                <div class="transaksi-info">
                    <div class="info-label">Peminjam</div>
                    <div class="info-value">{{ $item->peminjaman->peminjam }}</div>
                </div>
                <div class="transaksi-info">
                    <div class="info-label">Tanggal Kembali</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</div>
                </div>
                <div class="transaksi-info">
                    <div class="info-label">Kondisi</div>
                    <div>
                        @if($item->kondisi == 'baik')
                            <span class="kondisi-badge kondisi-baik">🟢 Baik</span>
                        @elseif($item->kondisi == 'rusak')
                            <span class="kondisi-badge kondisi-rusak">🟡 Rusak</span>
                        @else
                            <span class="kondisi-badge kondisi-hilang">🔴 Hilang</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Barang</th>
                    <th class="text-center" style="width: 150px;">Jumlah Dikembalikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item->detail as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->item->nama_item }}</td>
                    <td class="text-center">{{ $detail->jumlah }} pcs</td>
                </tr>
                @endforeach
                
                @if($item->catatan)
                <tr class="catatan-row">
                    <td colspan="3" style="padding: 15px 20px;">
                        <div class="catatan-label">Catatan Petugas:</div>
                        <div class="catatan-text">"{{ $item->catatan }}"</div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @empty
    <div class="no-data">
        <strong>Tidak ada data pengembalian.</strong>
    </div>
    @endforelse

    <div class="summary">
        <div class="summary-item">
            <div class="summary-value">{{ $pengembalian->count() }}</div>
            <div class="summary-label">Total Transaksi</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $pengembalian->sum(function($item) { return $item->detail->sum('jumlah'); }) }}</div>
            <div class="summary-label">Total Barang</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $pengembalian->where('kondisi', 'baik')->count() }}</div>
            <div class="summary-label">Kondisi Baik</div>
        </div>
    </div>

    <div class="footer">
        <div class="signature-box">
            <div class="signature-label">Mengetahui,<br>Petugas Inventaris</div>
            <div class="signature-line">(__________________)</div>
        </div>
    </div>
</body>
</html>