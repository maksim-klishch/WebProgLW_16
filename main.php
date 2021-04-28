<?php

class File
{
    private $file;

    public function __construct(string $name)
    {
        $this->file = fopen($name, "a+");
    }

    public function writeInfo($monitorType, $resolution, $numberColors)
    {
        fwrite($this->file, $monitorType . " " . $resolution . " " . $numberColors . "\n");
    }

    public static function showAllInfoFromFile($name)
    {
        $lines = file($name);
        $num = count($lines); 

        echo 
        "<table>
            <tr>
                <td>Тип монітору</td>
                <td>Роздільна здатність</td>
                <td>Кількість кольорів</td>
            </tr>";

        for($i = 0; $i < $num; $i += 3)
        {
            echo "<tr>";
            echo "<td>" . $lines[$i] . "</td>";
            echo "<td>" . $lines[$i + 1] . "</td>";
            echo "<td>" . $lines[$i + 2] . "</td>";
            echo "</tr>";
        }   

        echo "</table>";
    }

    public function __destruct()
    {
        fclose($this->file);
    }
}

$monitorType = $_POST["monitorType"];
$resolution = $_POST["resolution"];
$numberColors = $_POST["numberColors"];

$fileName = "file.txt";

if(isset($_POST["btn_add"]))
{
    if(isset($monitorType) && isset($resolution) && isset($numberColors))
    {
        echo "Дані успішно додано у файл<br/>";
        $file = new File($fileName);
        $file->writeInfo($monitorType, $resolution, $numberColors);
    }
    else
    {
        echo "Ви не заповнили всі необхідні поля<br/>";
    }
}

if(isset($_POST["btn_view"]))
{
    File::showAllInfoFromFile($fileName);
}

echo "<a href=\"form.html\">Повернутися</a>"

?>