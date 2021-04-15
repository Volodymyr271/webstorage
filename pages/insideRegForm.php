<table>
    <tr>
        <td>
            Электронная почта:
        </td>
        <td align="left">
            <input id="login" type="text" maxlength="30" />
        </td>
    </tr>
    <tr>
        <td>
            Пароль:
        </td>
        <td align="left">
            <input type ="password" maxlength="30" id="password" />
        </td>
    </tr>
    <tr>
        <td>
            Повторите пароль:
        </td>
        <td align="left">
            <input type ="password" maxlength="30" id="passwordRepeat"/>
        </td>
    </tr>
    <tr>
        <td>
            Имя:
        </td>
        <td align="left">
            <input type ="text" maxlength="30" id="userName"/>
        </td>
    </tr>
    <tr>
        <td>
            Файл меню:
        </td>
        <td align="left">
            <select size="1"><option id ="menuType" value="default.json">Базовое меню пользователя</option></select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" value ="Зарегистрировать" onclick="sendUserData(this)"></br>
            <span id="msgbox"></span></br>
        </td>
    </tr>
</table>

