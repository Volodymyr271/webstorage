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
            <input type ="password" maxlength="30" id="password" /><button value ="изменить" onclick="editUser(this, 'password')">Изменить</button>
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
            <input type ="text" maxlength="30" id="userName"/><button value ="изменить" onclick="editUser(this, 'name')">Изменить</button>
        </td>
    </tr>
    <tr>
        <td>
            Файл меню:
        </td>
        <td align="left">
            <select size="1"><option id ="menuType" value="default.json">Базовое меню пользователя</option></select><button value ="изменить" onclick="editUser(this, 'menuType')">Изменить</button>
        </td>
    </tr>
</table>

