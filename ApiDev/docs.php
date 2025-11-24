<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>API Documentation — Dark</title>

  <!-- Prism for syntax highlighting (CDN) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />

  <style>
    :root{
      --bg:#0b1220; --card:#0f1724; --muted:#98a0b3; --accent:#7dd3fc; --accent-2:#60a5fa; --success:#34d399; --danger:#fb7185;
      --surface:#0d1420; --glass: rgba(255,255,255,0.03);
      --radius:12px; --max-width:1100px;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    *{box-sizing:border-box}
    html,body{height:100%; background:linear-gradient(180deg,#05060a 0%, #071027 100%); color:#e6eef6}

    /* layout */
    .app{display:flex; min-height:100vh}
    .sidebar{width:300px; background:linear-gradient(180deg,var(--card),#071226); padding:28px; border-right:1px solid rgba(255,255,255,0.03)}
    .main{flex:1; padding:28px; display:flex; flex-direction:column; gap:18px}

    /* brand */
    .brand{display:flex;align-items:center;gap:12px;margin-bottom:18px}
    .logo{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:700;color:#041024}
    .brand h1{font-size:16px;margin:0}
    .brand p{margin:0;font-size:12px;color:var(--muted)}

    /* search */
    .search{display:flex;gap:8px;margin-bottom:16px}
    .search input{flex:1;padding:10px 12px;border-radius:10px;background:var(--glass);border:1px solid rgba(255,255,255,0.03);color:var(--accent);outline:none}
    .search button{padding:10px 12px;border-radius:10px;background:transparent;border:1px solid rgba(255,255,255,0.04);color:var(--accent);cursor:pointer}

    /* nav */
    nav ul{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px}
    nav a{display:block;padding:10px 12px;border-radius:8px;color:var(--muted);text-decoration:none;font-size:14px}
    nav a.active, nav a:hover{background:rgba(255,255,255,0.02); color:var(--accent);}

    /* header */
    .header{display:flex;justify-content:space-between;align-items:center}
    .title{font-size:20px;font-weight:600}
    .meta{color:var(--muted);font-size:13px}

    /* content card */
    .card{background:linear-gradient(180deg,var(--surface), rgba(255,255,255,0.02)); padding:20px; border-radius:var(--radius); box-shadow: 0 6px 20px rgba(0,0,0,0.4); border:1px solid rgba(255,255,255,0.02);}

    /* endpoint */
    .endpoint{display:flex;gap:14px;align-items:center;margin-bottom:12px}
    .method{padding:6px 10px;border-radius:8px;font-weight:700;font-size:13px;background:rgba(255,255,255,0.03);color:var(--accent)}
    .path{font-family:monospace;color:#cfeefe}

    /* details */
    .section{margin-top:12px}
    .kbd{display:inline-block;padding:6px 10px;border-radius:8px;background:rgba(255,255,255,0.03);font-family:monospace}

    pre{background:transparent;padding:12px;border-radius:8px;overflow:auto}
    code{font-family: "Source Code Pro", monospace}

    /* small actions */
    .row{display:flex;gap:10px;align-items:center}
    .btn{padding:8px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:var(--accent);cursor:pointer}

    /* responsive */
    @media(max-width:900px){.sidebar{display:none}.app{flex-direction:column}.container{width:95%;margin:0 auto;padding-top:12px}}

    /* table */
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:10px;border-bottom:1px dashed rgba(255,255,255,0.03);text-align:left;color:var(--muted)}
    th{color:var(--accent)}
  </style>
</head>
<body>
  <div class="app">
    <aside class="sidebar">
      <div class="brand">
        <div class="logo">API</div>
        <div>
          <h1>API Documentation</h1>
          <p>Dark theme • Perpustakaan</p>
        </div>
      </div>

      <div class="search">
        <input id="searchInput" placeholder="Cari (endpoint, kata kunci)..."/>
        <button id="clearSearch">✖</button>
      </div>

      <nav>
        <ul id="navList">
          <li><a href="#intro" class="active">Introduction</a></li>
          <li><a href="#auth">Authentication</a></li>
          <li><a href="#endpoints">Endpoints</a></li>
          <li><a href="#examples">Contoh Request</a></li>
          <li><a href="#responses">Response & Error</a></li>
          <li><a href="#schema">Schema Data</a></li>
          <li><a href="#changelog">Changelog</a></li>
        </ul>
      </nav>

      <div style="margin-top:18px;color:var(--muted);font-size:13px">
        <div><strong>Base URL</strong></div>
        <div class="kbd">https://your-project.firebaseio.com/</div>
      </div>
    </aside>

    <main class="main">
      <div class="header">
        <div>
          <div class="title">API Documentation</div>
          <div class="meta">Dokumentasi API untuk layanan perpustakaan — dark theme</div>
        </div>
        <div class="row">
          <button class="btn" onclick="print()">Print / PDF</button>
          <button class="btn" id="copyBase">Copy Base URL</button>
        </div>
      </div>

      <div id="content">

        <section id="intro" class="card">
          <h3>Introduction</h3>
          <p style="color:var(--muted)">Dokumentasi ini menjelaskan endpoint REST untuk mengelola koleksi buku pada sistem perpustakaan. Contoh payload, kode curl, dan contoh respons disertakan.</p>
        </section>

        <section id="auth" class="card section">
          <h3>Authentication</h3>
          <p style="color:var(--muted)">Firebase Realtime Database biasanya menggunakan rules &amp; token. Untuk API HTTP via REST, sertakan token akses sebagai query param atau header:</p>
          <pre><code class="language-bash">GET https://your-project.firebaseio.com/buku.json?auth=&lt;TOKEN&gt;</code></pre>
          <p style="color:var(--muted)">Atau gunakan header Authorization Bearer ketika menggunakan custom backend.</p>
        </section>

        <section id="endpoints" class="card section">
          <h3>Endpoints</h3>

          <div class="endpoint"><div class="method">GET</div><div class="path">/buku</div></div>
          <div style="color:var(--muted)">Mengambil daftar semua buku.</div>
          <pre><code class="language-bash">curl -X GET "https://your-project.firebaseio.com/buku.json?auth=&lt;TOKEN&gt;"</code></pre>

          <div class="endpoint"><div class="method">GET</div><div class="path">/buku/{id}</div></div>
          <div style="color:var(--muted)">Mengambil detail buku berdasarkan ID.</div>
          <pre><code class="language-bash">curl -X GET "https://your-project.firebaseio.com/buku/{id}.json?auth=&lt;TOKEN&gt;"</code></pre>

          <div class="endpoint"><div class="method">POST</div><div class="path">/buku</div></div>
          <div style="color:var(--muted)">Menambahkan buku baru (push dengan key otomatis).</div>
          <pre><code class="language-bash">curl -X POST "https://your-project.firebaseio.com/buku.json?auth=&lt;TOKEN&gt;" \
  -H "Content-Type: application/json" \
  -d '{"judul":"Belajar Python","kategori":"Teknologi","stok":10,"pengarang":"Anonim","tahun":2022}'
</code></pre>

          <div class="endpoint"><div class="method">PUT / PATCH</div><div class="path">/buku/{id}</div></div>
          <div style="color:var(--muted)">Update data buku (PUT untuk ganti seluruh node, PATCH untuk partial).</div>
          <pre><code class="language-bash">curl -X PATCH "https://your-project.firebaseio.com/buku/{id}.json?auth=&lt;TOKEN&gt;" \
  -H "Content-Type: application/json" \
  -d '{"stok":15}'
</code></pre>

          <div class="endpoint"><div class="method">DELETE</div><div class="path">/buku/{id}</div></div>
          <div style="color:var(--muted)">Menghapus buku.</div>
          <pre><code class="language-bash">curl -X DELETE "https://your-project.firebaseio.com/buku/{id}.json?auth=&lt;TOKEN&gt;"</code></pre>

        </section>

        <section id="examples" class="card section">
          <h3>Contoh Request (PHP — Kreait SDK)</h3>
          <pre><code class="language-php">// tambah buku (Kreait)
$factory = (new \Kreait\Firebase\Factory)->withServiceAccount('service-account.json')->withDatabaseUri('https://your-project.firebaseio.com/');
$database = $factory->createDatabase();
$data = ['judul'=>'Belajar Python','kategori'=>'Teknologi','stok'=>10,'pengarang'=>'Anonim','tahun'=>2022];
$id = $database->getReference('buku')->push($data)->getKey();
</code></pre>

          <h4>Contoh Response (GET /buku/{id})</h4>
          <pre><code class="language-json">{
  "judul": "Belajar Python",
  "kategori": "Teknologi",
  "stok": 10,
  "pengarang": "Anonim",
  "tahun": 2022
}
</code></pre>
        </section>

        <section id="responses" class="card section">
          <h3>Response & Error</h3>
          <table>
            <thead><tr><th>Kode</th><th>Makna</th><th>Contoh</th></tr></thead>
            <tbody>
              <tr><td>200</td><td>OK — request sukses</td><td>Data JSON / objek</td></tr>
              <tr><td>400</td><td>Bad Request — payload tidak valid</td><td>error object</td></tr>
              <tr><td>401</td><td>Unauthorized — token invalid</td><td>error object</td></tr>
              <tr><td>404</td><td>Not Found — ID tidak ada</td><td>empty / null</td></tr>
              <tr><td>500</td><td>Server Error</td><td>error message</td></tr>
            </tbody>
          </table>
        </section>

        <section id="schema" class="card section">
          <h3>Schema Data (buku)</h3>
          <pre><code class="language-json">{
  "judul": "string",
  "kategori": "string",
  "stok": "integer",
  "pengarang": "string",
  "tahun": "integer"
}
</code></pre>
        </section>

        <section id="changelog" class="card section">
          <h3>Changelog</h3>
          <ul style="color:var(--muted)">
            <li>2025-11-23 — Initial API docs (CRUD buku)</li>
          </ul>
        </section>

      </div>

    </main>
  </div>

  <!-- Prism JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
  <script>
    // navigation highlight
    document.querySelectorAll('nav a').forEach(a=>{
      a.addEventListener('click', (e)=>{
        document.querySelectorAll('nav a').forEach(x=>x.classList.remove('active'));
        a.classList.add('active');
      });
    });

    // copy base url
    document.getElementById('copyBase').addEventListener('click', ()=>{
      navigator.clipboard.writeText('https://your-project.firebaseio.com/').then(()=>{
        alert('Base URL copied to clipboard')
      })
    })

    // search filter sidebar + content
    const searchInput = document.getElementById('searchInput');
    const navLinks = Array.from(document.querySelectorAll('#navList a'));
    const sections = Array.from(document.querySelectorAll('#content section'));

    function filter(q){
      q = q.trim().toLowerCase();
      if(!q){ navLinks.forEach(a=>a.style.display='block'); sections.forEach(s=>s.style.display='block'); return; }
      navLinks.forEach(a=>{
        const target = document.querySelector(a.getAttribute('href'));
        const text = (a.textContent + ' ' + target.innerText).toLowerCase();
        if(text.indexOf(q) !== -1){ a.style.display='block'; target.style.display='block'; } else { a.style.display='none'; target.style.display='none'; }
      })
    }

    searchInput.addEventListener('input', ()=>filter(searchInput.value));
    document.getElementById('clearSearch').addEventListener('click', ()=>{ searchInput.value=''; filter(''); });

    // hash navigation: smooth scroll
    document.querySelectorAll('#navList a').forEach(a=>{
      a.addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(a.getAttribute('href')).scrollIntoView({behavior:'smooth', block:'start'});
      })
    });
  </script>
</body>
</html>