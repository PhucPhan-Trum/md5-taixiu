const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(express.json());
app.use(express.static('public'));

app.post('/api/phantich', (req, res) => {
    const { md5 } = req.body;

    if (!md5 || (md5.length !== 32 && md5.length !== 64)) {
        return res.status(400).json({ error: 'MD5 không hợp lệ' });
    }

    const lastChar = md5.trim().toLowerCase().slice(-1);
    const value = parseInt(lastChar, 16);

    if (isNaN(value)) {
        return res.status(400).json({ error: 'Không thể phân tích MD5' });
    }

    const hexTotal = value;
    const ketqua = value >= 8 ? 'TÀI' : 'XỈU';

    res.json({ md5, hexTotal, ketqua });
});

app.listen(PORT, () => {
    console.log(`🔥 API đang chạy tại http://localhost:${PORT}`);
});