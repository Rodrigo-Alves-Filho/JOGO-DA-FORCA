function guessLetter() {
    let letter = document.getElementById('letter').value;
    if (letter) {
        fetch('process_guess.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ letter: letter })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('wordDisplay').textContent = data.hiddenWord;
                if (data.won) {
                    alert('Você venceu!');
                    location.reload();  
                }
                if (data.lost) {
                    alert('Você perdeu!');
                    location.reload();  
                }
                drawHangman(data.attempts);
            } else {
                alert('Erro: ' + data.message);
            }
        });
    }
    document.getElementById('letter').value = '';
}

function drawHangman(attempts) {
    const parts = ['head', 'body', 'leftArm', 'rightArm', 'leftLeg', 'rightLeg'];
    parts.forEach((part, index) => {
        document.getElementById(part).style.display = (index < attempts) ? 'block' : 'none';
    });
}