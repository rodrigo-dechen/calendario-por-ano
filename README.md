#Calendário por ano

Este é um projeto | desafio que inicie em inspiração a uma publicação no facebook.

https://www.facebook.com/groups/osadpa/permalink/1565130443592477

##Referências

Usei como referência o cálculo para saber qual é o dia da semana cai qualquer dia, cálculo descrito no vídeo do Prof. Rafael Procopio do canal Matemática Rio com Prof. Rafael Procopio.

Video: https://www.youtube.com/watch?v=u7NAy_kDZ3A

E usei também o cálculo do ano bissexto descrito no wikipedia, uma explicação bem detalhada e com exemplos de código.

Pagina: https://pt.wikipedia.org/wiki/Ano_bissexto

##Cálculos

###Dia da semana de qualquer dia da história.

```php
$d = 6;     //dia
$m = 7;     //mes
$a = 1990;  //ano

$k = (($d + (2 * $m) + floor((3 * ($m + 1)) / 5) + ($a + floor($a / 4) - floor($a / 100) + floor($a / 400) + 2)) % 7);
```

Temos também de considerar a possibilidade de anos bissexto, para tanto o Prof. Rafael Procopio pede para considerarmos Janeiro e Fevereiro como pertencentes ao ano anterior mas como memes 13 e 14 respectivamente.

```php
$dia = 6;     //dia
$mes = 7;     //mes
$ano = 1990;  //ano

$d = $dia;                           //dia
$m = (($mes <= 2)? $mes + 12: $mes); //mes
$a = (($mes <= 2)? $ano -  1: $ano); //ano

$k = (($d + (2 * $m) + floor((3 * ($m + 1)) / 5) + ($a + floor($a / 4) - floor($a / 100) + floor($a / 400) + 2)) % 7);
```

Calculando `$k` como descrito no vídeo do Prof. Rafael Procopio, e seu resultado é definido usando o seguinte array descrito pelo Porf.

```php
$semanaResultado = [
    0 => 'Sabado',
    1 => 'Domingo',
    2 => 'Segunda',
    3 => 'Terça',
    4 => 'Quarta',
    5 => 'Quinta',
    6 => 'Sexta',
];
```

Entretanto nos códigos o dia inicial da semana não é sábado, mas sim domingo, para tanto usei um array para converter o resultado da fórmula para o resultado esperado, array: 

```php
$resultadoEsperado = [
    0 => 6,
    1 => 0,
    2 => 1,
    3 => 2,
    4 => 3,
    5 => 4,
    6 => 5,
];
```

Com `$resultadoEsperado` eu obtia o resultado tendo como Domingo sendo o dia 0 da semana.

###Calculo do ano bissexto 

```php
$ano = 1990;  //ano

$bissexto = (($ano % 400 == 0) || (($ano % 4 == 0) && ($ano % 100 != 0)));
```

Esse cálculo é bem simples e segue uma um algoritmo bem interessante.

- Todo ano divisível por 4 é bissexto.
- Todo ano divisível por 100 não é bissexto.
- Todo ano divisível por 400 é bissexto.

OBS.: As regras abaixo na lista vale mais que a de cima.

Essas regras concluem que o ano tem 365,2425 dias. Resolvido com a seguinte conta.

```
365 + (1 / 400) + (1 / 4) - (1 / 100) = 365,2425
```

##Modo de uso

Para usar, é preciso colocar o código em um servidor web que use php. depois acessar diretamente o arquivo como:

```
localhost/calendario-por-ano.php
```

O script toma como padrão o ano atual para gerar o calendário. Para que ver o calendário de outros anos basta acrescentar uma query na url da seguinte maneira: 

```
localhost/calendario-por-ano.php?ano=1990
```

`ano` será o ano que vc quer ver o calendário.

##Resultado

O resultado sairá como no exemplo a seguir:

```
                                            1990                                            
╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ 
║      Janeiro       ║ ║     Fevereiro      ║ ║       Marco        ║ ║       Abril        ║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║    1  2  3  4  5  6║ ║             1  2  3║ ║             1  2  3║ ║ 1  2  3  4  5  6  7║ 
║ 7  8  9 10 11 12 13║ ║ 4  5  6  7  8  9 10║ ║ 4  5  6  7  8  9 10║ ║ 8  9 10 11 12 13 14║ 
║14 15 16 17 18 19 20║ ║11 12 13 14 15 16 17║ ║11 12 13 14 15 16 17║ ║15 16 17 18 19 20 21║ 
║21 22 23 24 25 26 27║ ║18 19 20 21 22 23 24║ ║18 19 20 21 22 23 24║ ║22 23 24 25 26 27 28║ 
║28 29 30 31         ║ ║25 26 27 28         ║ ║25 26 27 28 29 30 31║ ║29 30               ║ 
║                    ║ ║                    ║ ║                    ║ ║                    ║ 
╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ 
╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ 
║        Maio        ║ ║       Junho        ║ ║       Julho        ║ ║       Agosto       ║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║       1  2  3  4  5║ ║                1  2║ ║ 1  2  3  4  5  6  7║ ║          1  2  3  4║ 
║ 6  7  8  9 10 11 12║ ║ 3  4  5  6  7  8  9║ ║ 8  9 10 11 12 13 14║ ║ 5  6  7  8  9 10 11║ 
║13 14 15 16 17 18 19║ ║10 11 12 13 14 15 16║ ║15 16 17 18 19 20 21║ ║12 13 14 15 16 17 18║ 
║20 21 22 23 24 25 26║ ║17 18 19 20 21 22 23║ ║22 23 24 25 26 27 28║ ║19 20 21 22 23 24 25║ 
║27 28 29 30 31      ║ ║24 25 26 27 28 29 30║ ║29 30 31            ║ ║26 27 28 29 30 31   ║ 
║                    ║ ║                    ║ ║                    ║ ║                    ║ 
╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ 
╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ ╔════════════════════╗ 
║      Setembro      ║ ║      Outubro       ║ ║      Novembro      ║ ║      Dezembro      ║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ ║ D  S  T  Q  Q  S  S║ 
╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ ╠════════════════════╣ 
║                   1║ ║    1  2  3  4  5  6║ ║             1  2  3║ ║                   1║ 
║ 2  3  4  5  6  7  8║ ║ 7  8  9 10 11 12 13║ ║ 4  5  6  7  8  9 10║ ║ 2  3  4  5  6  7  8║ 
║ 9 10 11 12 13 14 15║ ║14 15 16 17 18 19 20║ ║11 12 13 14 15 16 17║ ║ 9 10 11 12 13 14 15║ 
║16 17 18 19 20 21 22║ ║21 22 23 24 25 26 27║ ║18 19 20 21 22 23 24║ ║16 17 18 19 20 21 22║ 
║23 24 25 26 27 28 29║ ║28 29 30 31         ║ ║25 26 27 28 29 30   ║ ║23 24 25 26 27 28 29║ 
║30                  ║ ║                    ║ ║                    ║ ║30 31               ║ 
╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ ╚════════════════════╝ 
```

OBS.: Março aparece sem "ç" pôs bugava o layout.

##Agradecimentos

Agradecimentos ao Cristian Mota por ter crido o post que me incentivou a criar este código, agradecimentos ao Prof. Rafael Procopio por seu vídeo explicando a fórmula, e agradecimentos a wikipédia e seus colaboradores com sua explicação super satisfatória sobre o ano bissexto.
