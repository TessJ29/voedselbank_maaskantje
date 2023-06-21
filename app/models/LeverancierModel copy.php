<?php
class LeverancierModel
{
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeveranciers()
    {
        $this->db->query('SELECT Leverancier.Naam,
                                 Leverancier.ContactPersoon,
                                 Contact.Email,
                                 Contact.Mobiel,
                                 Leverancier.LeverancierNummer,
                                 Leverancier.LeverancierType,
                                 Leverancier.Id as leverId
                          from Leverancier
                          inner join ContactPerLeverancier on Leverancier.Id = ContactPerLeverancier.LeverancierId
                          inner join Contact on ContactPerLeverancier.ContactId = Contact.Id;');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getLeverancierById($Id)
    {
        $this->db->query('SELECT Leverancier.Naam,
                                 Leverancier.ContactPersoon,
                                 Contact.Email,
                                 Contact.Mobiel,
                                 Leverancier.LeverancierNummer,
                                 Leverancier.LeverancierType,
                                 Leverancier.Id
                          from Leverancier
                          inner join ContactPerLeverancier on Leverancier.Id = ContactPerLeverancier.LeverancierId
                          inner join Contact on ContactPerLeverancier.ContactId = Contact.Id
                          where Leverancier.Id = :Id;');
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function getProductById($Id)
    {
        $this->db->query('SELECT Leverancier.Naam,
                             Leverancier.LeverancierNummer,
                             Leverancier.LeverancierType,
                             Product.SoortAllergie,
                             Product.Barcode,
                             Product.Naam as Pnaam,
                             Product.Houdbaarheidsdatum,
                             Product.Id as ProductId, -- Add this line
                             Leverancier.Id as leverId
                        from Leverancier
                        inner join ProductPerLeverancier on Leverancier.Id = ProductPerLeverancier.LeverancierId
                        inner join Product on ProductPerLeverancier.ProductId = Product.Id
                        where Leverancier.Id = :Id;');

        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        return $this->db->single();
    }




    public function getLeverancierProducts($Id)
    {
        $this->db->query('SELECT Leverancier.Naam,
                             Leverancier.LeverancierNummer,
                             Leverancier.LeverancierType,
                             Product.SoortAllergie,
                             Product.Barcode,
                             Product.Naam as Pnaam,
                             Product.Houdbaarheidsdatum,
                             Leverancier.Id as leverId
                      from Leverancier
                      inner join ProductPerLeverancier on Leverancier.Id = ProductPerLeverancier.LeverancierId
                      inner join Product on ProductPerLeverancier.ProductId = Product.Id
                      where Leverancier.Id = :Id;');

        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }


    public function ProductUpdate($post)
    {
        $this->db->query("UPDATE `Product`
                     SET Product.Houdbaarheidsdatum = :Houdbaarheidsdatum
                     WHERE Product.Id = :ProductId");
        $this->db->bind(':Houdbaarheidsdatum', $post["Houdbaarheidsdatum"], PDO::PARAM_STR);
        $this->db->bind(':ProductId', $post["ProductId"], PDO::PARAM_INT);
        return $this->db->execute();
    }
}
