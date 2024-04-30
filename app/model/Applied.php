<?php

class Applied extends Model
{
    protected $table = 'first_round_data';

    private $connection;


    public function __construct()
    {
        $this->connection = $this->connection();
    }

    // public function apply($userId, $adId)
    // {
    //     // Check if the user has already applied for the job
    //     $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('i', $userId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $existingEntry = $result->fetch_assoc();

    //     if ($existingEntry) {
    //         // User has already applied for a job
    //         $appliedId = $existingEntry['id'];

    //         // Check if the user has already applied for the same ad
    //         $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
    //         $stmt2 = $this->connection->prepare($query2);
    //         $stmt2->bind_param('i', $appliedId);
    //         $stmt2->execute();
    //         $result2 = $stmt2->get_result();
    //         $existingAdEntry = $result2->fetch_assoc();

    //         if ($existingAdEntry && $existingAdEntry['ad_id'] == $adId) {
    //             // User has already applied for this ad, return false
    //             return false;
    //         }
    //     } else {
    //         // User hasn't applied for any job yet
    //         // Insert a new entry into the applyadvertisement table
    //         $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 1)";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param('ii', $userId, 1);
    //         $success = $stmt->execute();

    //         if (!$success) {
    //             // Failed to insert into the applyadvertisement table
    //             return false;
    //         }

    //         // Get the inserted id
    //         $appliedId = $stmt->insert_id;
    //     }

    //     // Insert a new entry into the first_round_data table
    //     $query = "INSERT INTO first_round_data (ad_id, applied_id) VALUES (?, ?)";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('ii', $adId, $appliedId);
    //     $success = $stmt->execute();

    //     return $success;
    // }

    public function alreadyApplied($studentId, $adId)
    {
        // Check if the user has already applied for any job
        $query = "SELECT COUNT(*) AS num_applied FROM applyadvertisement AS aa 
                  JOIN first_round_data AS frd ON aa.id = frd.applied_id 
                  WHERE aa.applied_by = ? AND frd.ad_id = ?";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            // Handle the error if prepare() fails
            return ['success' => false, 'message' => 'Error preparing statement'];
        }

        $stmt->bind_param('ii', $studentId, $adId);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        if ($row['num_applied'] > 0) {
            // User has already applied for this ad
            return true;
        } else {
            // User has not applied for this ad
            return false;
        }
    }


    public function apply($studentId, $adId, $round)
    {
        $cvFlood = $this->checkForCVFlooding($adId);
        if (!$cvFlood) {
            $validity = $this->validateApplication($studentId, $round);
            if ($validity) {
                // Check if the user has already applied for any job
                $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
                $stmt = $this->connection->prepare($query);

                $stmt->bind_param('i', $studentId);
                $stmt->execute();

                $result = $stmt->get_result();

                $existingEntries = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($existingEntries as $existingEntry) {
                    $appliedId = $existingEntry['id'];

                    // Check if the user has already applied for the same ad
                    $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
                    $stmt2 = $this->connection->prepare($query2);

                    if (!$stmt2) {
                        // Handle the error if prepare() fails
                        return ['success' => false, 'message' => 'Error preparing statement'];
                    }

                    $stmt2->bind_param('i', $appliedId);
                    $stmt2->execute();

                    $result2 = $stmt2->get_result();

                    if (!$result2) {
                        // Handle the error if get_result() fails
                        return ['success' => false, 'message' => 'Error executing statement'];
                    }

                    $existingAdEntry = $result2->fetch_assoc();

                    if ($existingAdEntry && $existingAdEntry['ad_id'] == $adId) {
                        // User has already applied for this ad, return false
                        return ['success' => false, 'message' => 'You have already applied for this job'];
                    }
                }

                // If the loop completes without finding a match, insert new entries
                $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 1)";
                $stmt = $this->connection->prepare($query);

                if (!$stmt) {
                    // Handle the error if prepare() fails
                    return ['success' => false, 'message' => 'Error preparing statement'];
                }

                $stmt->bind_param('i', $studentId);
                $success = $stmt->execute();

                if (!$success) {
                    // Failed to insert into the applyadvertisement table
                    return ['success' => false, 'message' => 'Error applying for job'];
                }

                // Get the inserted id
                $appliedId = $stmt->insert_id;

                // Insert a new entry into the first_round_data table
                $query = "INSERT INTO first_round_data (ad_id, applied_id) VALUES (?, ?)";
                $stmt = $this->connection->prepare($query);

                if (!$stmt) {
                    // Handle the error if prepare() fails
                    return ['success' => false, 'message' => 'Error preparing statement'];
                }

                $stmt->bind_param('ii', $adId, $appliedId);
                $success = $stmt->execute();

                if ($success) {
                    $this->updateNoCVsRequired($adId);
                }

                return ['success' => $success];
            } else {
                return ['success' => false, 'message' => 'You have reached the maximum number of applications'];
            }
        } else {
            return ['success' => false, 'message' => 'No more applications are accepted for this ad'];
        }
    }

    public function checkForCVFlooding($adId)
    {
        $query = "SELECT no_of_cvs_required AS count FROM company_ad WHERE ad_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $adId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cvCount = $result->fetch_assoc();

        if ($cvCount['count'] > 0) {
            return false;
        } else {
            return true;
        }

    }

    public function validateApplication($studentId, $round)
    {
        // Query to get the count of unique entries in the applyadvertisement table for the given student
        $query = "SELECT COUNT(DISTINCT aa.id) AS applied_count, r.count AS round_count 
                  FROM applyadvertisement AS aa
                  JOIN round AS r ON r.id = aa.round_id
                  WHERE aa.applied_by = ?
                  AND aa.round_id = ?
                  GROUP BY aa.applied_by, r.count";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ii', $studentId, $round);
        $stmt->execute();
        $result = $stmt->get_result();

        $counts = $result->fetch_assoc();

        // Check if the applied count is less than or equal to the round count
        if ($counts['applied_count'] >= $counts['round_count']) {
            return false;
        } else {
            return true;
        }
    }

    private function updateNoCVsRequired($adId)
    {
        // Update no_cvs_required column in company_ad table
        $query = "UPDATE company_ad SET no_of_cvs_required = no_of_cvs_required - 1 WHERE ad_id = ?";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            // Handle the error if prepare() fails
            return false;
        }

        $stmt->bind_param('i', $adId);
        $success = $stmt->execute();

        return $success;
    }

    public function fetchApplicationStatus($studentId, $adId)
    {
        $query = "SELECT status 
                    FROM first_round_data
                    JOIN applyadvertisement ON applyadvertisement.id = first_round_data.applied_id
                    WHERE first_round_data.ad_id = ?
                    AND applyadvertisement.applied_by = ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ii', $adId, $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If there is a row in the result set, fetch the status
            $row = $result->fetch_assoc();
            $status = $row['status'];
            return $status;
        } else {
            // If no row is found, return null or handle the absence of status as needed
            return null;
        }
    }

    // public function apply($userId, $adId){
    //     $query = "SELECT * FROM $this->table WHERE applied_by = ? AND ad_id = ?";
    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bind_param('ii', $userId, $adId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $existingEntry = $result->fetch_assoc();

    //     if($existingEntry){
    //         return false;
    //     }
    //     else {
    //         $query = "INSERT INTO $this->table (applied_by, ad_id) VALUES (?, ?)";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param('ii', $userId, $adId);
    //         $success = $stmt->execute();

    //         return $success;
    //     }
    // }

    public function fetchAppliedAdIds($studentId)
    {

        $query = "SELECT id FROM applyadvertisement WHERE applied_by = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        $existingEntries = $result->fetch_all(MYSQLI_ASSOC);
        $appliedAdIds = [];

        foreach ($existingEntries as $existingEntry) {
            $appliedId = $existingEntry['id'];

            $query2 = "SELECT ad_id FROM first_round_data WHERE applied_id = ?";
            $stmt2 = $this->connection->prepare($query2);


            $stmt2->bind_param('i', $appliedId);
            $stmt2->execute();

            $result2 = $stmt2->get_result();


            $appliedAdEntry = $result2->fetch_assoc();

            if ($appliedAdEntry) {
                $appliedAdIds[] = $appliedAdEntry['ad_id'];
            }

        }

        return $appliedAdIds;
    }


    public function fetchAppliedAdsCount($studentId)
    {

        $query = "SELECT COUNT(DISTINCT frd.ad_id) AS count 
                  FROM applyadvertisement AS aa 
                  INNER JOIN first_round_data AS frd ON aa.id = frd.applied_id 
                  WHERE aa.applied_by = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $appliedAdsCount = $result->fetch_assoc();

        return $appliedAdsCount['count'];
    }


    // second round applications

    // public function applySecondRound($studentId, $preferences){

    //     $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 2)";
    //     $stmt = $this->connection->prepare($query);

    //     if (!$stmt) {
    //         // Handle the error if prepare() fails
    //         return ['success' => false, 'message' => 'Error preparing statement'];
    //     }

    //     $stmt->bind_param('i', $studentId);
    //     $success = $stmt->execute();

    //     if (!$success) {
    //         // Failed to insert into the applyadvertisement table
    //         return ['success' => false, 'message' => 'Error applying for job'];
    //     }

    //     // Get the inserted id
    //     $appliedId = $stmt->insert_id;

    //     $preferencesString = implode("','", $preferences);
    //     // Insert a new entry into the first_round_data table
    //     $query = "INSERT INTO second_round_data (applied_id, job_role) VALUES (?, ?)";
    //     $stmt = $this->connection->prepare($query);
    //     if (!$stmt) {
    //         // Handle the error if prepare() fails
    //         return ['success' => false, 'message' => 'Error preparing statement'];
    //     }
    //     $preferencesString = "'" . $preferencesString . "'";
    //     $stmt->bind_param('is', $appliedId, $preferencesString);
    //     $success = $stmt->execute();

    //     if (!$success) {
    //         // Failed to insert preferences into second_round_data table
    //         return ['success' => false, 'message' => 'Error inserting preferences'];
    //     }

    //     // Search for relevant job ads based on preferences
    //     $relevantAds = $this->findRelevantJobAds($preferences);

    //     // Apply to relevant advertisements
    //     foreach ($relevantAds as $ad) {
    //         $applySuccess = $this->applyToSecondRoundAds($appliedId, $ad['ad_id']);
    //         if (!$applySuccess) {
    //             // Log the error or perform error handling actions
    //             error_log("Failed to apply to advertisement with ID: " . $ad['ad_id']);
    //         }
    //     }


    //     return ['success' => true];    
    // }
    public function applySecondRound($studentId, $preferences)
    {

        // Extract job roles from preferences
        $jobRoles = [];
        foreach ($preferences as $key => $value) {
            // Check if the value is not an empty string
            if (!empty($value)) {
                $jobRoles[] = $value;
            }
        }

        // Insert application for second round
        $query = "INSERT INTO applyadvertisement (applied_by, round_id) VALUES (?, 2)";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            // Handle the error if prepare() fails
            return ['success' => false, 'message' => 'Error preparing statement'];
        }

        $stmt->bind_param('i', $studentId);
        $success = $stmt->execute();

        if (!$success) {
            // Failed to insert into the applyadvertisement table
            return ['success' => false, 'message' => 'Error applying for job'];
        }

        // Get the inserted id
        $appliedId = $stmt->insert_id;

        // Insert job roles into second_round_data table
        $query = "INSERT INTO second_round_data (applied_id, job_role) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            // Handle the error if prepare() fails
            return ['success' => false, 'message' => 'Error preparing statement'];
        }

        foreach ($jobRoles as $role) {
            $stmt->bind_param('is', $appliedId, $role);
            $success = $stmt->execute();

            if (!$success) {
                // Failed to insert job role into second_round_data table
                return ['success' => false, 'message' => 'Error inserting job role'];
            }
        }

        // Search for relevant job ads based on job roles
        $relevantAds = $this->findRelevantJobAds($jobRoles);

        // Apply to relevant advertisements
        foreach ($relevantAds as $ad) {
            $applySuccess = $this->applyToSecondRoundAds($appliedId, $ad['ad_id']);
            if (!$applySuccess) {
                // Log the error or perform error handling actions
                error_log("Failed to apply to advertisement with ID: " . $ad['ad_id']);
            }
            $this->updateNoCVsRequired($adId);
        }

        return ['success' => true];
    }


    private function findRelevantJobAds($preferences)
    {
        // Filter out empty preferences
        $preferences = array_filter($preferences);

        // Check if there are any preferences left
        if (empty($preferences)) {
            return []; // Return empty array if there are no preferences
        }

        // Prepare statement to search for relevant job ads
        $placeholders = str_repeat('?,', count($preferences) - 1) . '?'; // Create placeholders for each preference
        $query = "SELECT * FROM company_ad WHERE position IN ($placeholders)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            // Handle the error if prepare() fails
            return [];
        }

        // Bind parameters with proper types
        $types = str_repeat('s', count($preferences)); // Assuming all preferences are strings
        $stmt->bind_param($types, ...$preferences);

        $stmt->execute();
        $result = $stmt->get_result();
        $relevantAds = $result->fetch_all(MYSQLI_ASSOC);
        return $relevantAds;
    }


    private function applyToSecondRoundAds($appliedId, $adId)
    {
        // Insert application for a specific advertisement
        $query = "INSERT INTO second_round_application (applied_id, ad_id) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            // Handle the error if prepare() fails
            return false;
        }

        $stmt->bind_param('ii', $appliedId, $adId);
        $success = $stmt->execute();

        return $success;
    }

}