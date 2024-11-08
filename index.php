<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelişmiş Şifre Oluşturucu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }
        h2 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 1rem;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }
        .form-check-label {
            font-weight: normal;
            margin-left: 0.5rem;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }
        .btn-primary {
            background-color: #4A90E2;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
        .output {
            background-color: #f0f4f8;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-top: 1rem;
            word-break: break-all;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Gelişmiş Şifre Oluşturucu</h2>
    <form id="passwordForm">
        <label for="length">Şifre Uzunluğu (max 100)</label>
        <input type="number" id="length" class="form-control" min="4" max="100" value="10">
        
        <label>Harf Türü</label>
        <select id="caseType" class="form-control">
            <option value="mixed">Karma Harfler</option>
            <option value="uppercase">Büyük Harfler</option>
            <option value="lowercase">Küçük Harfler</option>
        </select>
        
        <input type="checkbox" id="includeNumbers" checked>
        <label for="includeNumbers">Rakam Ekle</label>
        
        <input type="checkbox" id="includeSymbols" checked>
        <label for="includeSymbols">Özel Karakter Ekle</label>
        
        <label for="excludeChars">Hariç Tutulacak Karakterler</label>
        <input type="text" id="excludeChars" class="form-control" placeholder="Örn: oO0">
        
        <label for="baseWord">Hatırlanabilir Kelime</label>
        <input type="text" id="baseWord" class="form-control" placeholder="Ali, Elma vb.">
        
        <button type="button" class="btn btn-primary" onclick="generatePassword()">Şifre Oluştur</button>
        <button type="button" class="btn btn-secondary" onclick="copyPassword()">Panoya Kopyala</button>
    </form>
    
    <div id="passwordDisplay" class="output">Şifreniz burada görünecek</div>
</div>

<script>
function generatePassword() {
    const length = Math.min(parseInt(document.getElementById('length').value), 100);
    const caseType = document.getElementById('caseType').value;
    const includeNumbers = document.getElementById('includeNumbers').checked;
    const includeSymbols = document.getElementById('includeSymbols').checked;
    const excludeChars = document.getElementById('excludeChars').value;
    const baseWord = document.getElementById('baseWord').value;
    
    let charset = "";
    if (caseType === "mixed") charset += "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if (caseType === "uppercase") charset += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if (caseType === "lowercase") charset += "abcdefghijklmnopqrstuvwxyz";
    if (includeNumbers) charset += "0123456789";
    if (includeSymbols) charset += "!@#$%^&*()";

    charset = charset.split('').filter(char => !excludeChars.includes(char)).join('');
    
    let password = baseWord;
    for (let i = password.length; i < length; i++) {
        password += charset.charAt(Math.floor(Math.random() * charset.length));
    }
    
    password = password.split('').sort(() => Math.random() - 0.5).join('');
    document.getElementById('passwordDisplay').textContent = password;
}

function copyPassword() {
    const passwordDisplay = document.getElementById('passwordDisplay').textContent;
    navigator.clipboard.writeText(passwordDisplay).then(() => {
        alert("Şifre panoya kopyalandı!");
    });
}
</script>


</body>
</html>
