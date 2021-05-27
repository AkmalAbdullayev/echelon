<?php
function validateText()
{
    $messages = [
        'required' => ':attribute ni to‘ldirish shart',
        'string' => ':attribute matn ko‘rinishida bo‘lishi shart!',
        'integer' => ':attribute raqam bo‘lishi shart!',
        'unique' => ':attribute allaqachon ro‘yhatdan o‘tgan!',
        'max' => ':attribute :max belgidan oshmasligi shart!',
        'min' => ':attribute :min belgidan kam bo‘lmasligi shart!',
        'regex' => ':attribute formati xato kiritildi!',
        'email' => ':attribute Email ko‘rinishida bo‘lishi shart!',
        'digits' => ':attribute :digits ta raqam bo‘lishi kerak!',
        'digits_between' => ':attribute 0 dan 99 gacha bo‘lishi kerak!',
        'date' => ':attribute sana ko\'rinishida bo\'lishi kerak'
    ];

    return $messages;
}
