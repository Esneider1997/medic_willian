<?php
function hashPassword($palinText){
    return password_hash($palinText, PASSWORD_BCRYPT);
}
function verifyPassword($plainText,$hash){
    return password_verify($plainText,$hash);
}
