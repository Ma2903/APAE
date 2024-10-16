<form action="" method="POST" id="reset-form" style="display:none;">
    <input type="hidden" name="email" value="" id="hidden-email">
    <section class="input-container">
        <label for="resposta-seguranca">Mude caso realmente for necessário</label>
        <!-- <input name="resposta-seguranca" type="text" id="resposta-seguranca" placeholder="Digite sua resposta de segurança" required> -->
    </section>
    
    <section class="input-container">
        <label for="new-password">Nova Senha:</label>
        <input name="password" type="password" id="password" placeholder="******" required>
        <span id="toggle-password" class="toggle-icon">
            <i class="fas fa-eye"></i>
        </span>
    </section>
    
    <section class="input-container">
        <label for="confirm-password">Confirmar Nova Senha:</label>
        <input name="Verifpassword" type="password" id="Verifpassword" placeholder="******" required>
        <span id="toggle-password" class="toggle-icon">
            <i class="fas fa-eye"></i>
        </span>
    </section>
    <button type="submit">Redefinir Senha</button>
</form>