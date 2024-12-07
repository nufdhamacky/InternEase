<?php

include_once('../app/model/AdvertisementModel.php');

class AdvertisementRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function save(AdvertisementModel $advertisement)
    {
        /* $sql = "INSERT INTO company_ad (position, requirements, no_of_intern, working_mode, from_date, to_date, company_id, qualification, other_qualifications, status, no_of_cvs_required)

                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        */
        // Add scale
        $sql = "INSERT INTO company_ad (position, requirements, no_of_intern, working_mode, from_date, to_date, company_id, qualification, other_qualifications, status, no_of_cvs_required , scale) 

                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return null; // Error handling
        }

        $stmt->bind_param(
            'ssisssissiii',
            $advertisement->position,
            $advertisement->requirements,
            $advertisement->interns,
            $advertisement->workingMode,
            $advertisement->fromDate,
            $advertisement->toDate,
            $advertisement->companyId,
            $advertisement->qualification,
            $advertisement->other_qualifications,
            $advertisement->status,
            $advertisement->no_of_cvs_required,
            $advertisement->scale
        );

        $result = $stmt->execute();

        return $result;
    }


    public function getAllAdvertisements(): array
    {
        $companyId = $_SESSION['userId'];
        $sql = "SELECT * FROM company_ad WHERE company_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('i', $companyId);
        $stmt->execute();
        $result = $stmt->get_result();

        $advertisements = [];
        while ($row = $result->fetch_assoc()) {
            $advertisement = new AdvertisementModel(
                $row['position'],
                $row['requirements'],
                $row['no_of_intern'],
                $row['working_mode'],
                $row['from_date'],
                $row['to_date'],
                $row['company_id'],
                $row['qualification'],
                $row['other_qualifications'], // Use correct field name
                $row['status'],
                $row['no_of_cvs_required'],
                $row['scale']
            );
            $advertisements[] = $advertisement;
        }

        return $advertisements;
    }
}
