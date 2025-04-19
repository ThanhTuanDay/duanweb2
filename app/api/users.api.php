<?php
require_once(dirname(__DIR__) . '../controller/user.controller.php');
$userController = new UserController();
?>

<?php
if (($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET['action'])) || ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['action']))) {
    $response = array(
        "success" => false,
        "message" => 'Invalid request method'
    );
    echo json_encode($response);
    exit();
}
?>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : $_POST["action"];
switch ($action) {
    case 'getDeliveryAddress':
        $listAddress = $userController->getDeliveryAddress();
        foreach ($listAddress as $address) {
            $response[] = [
                'id' => $address->getId(),
                'name' => $address->getName(),
                'address' => $address->getAddress(),
                'phone' => $address->getPhone(),
                'created_at' => $address->getCreatedAt()
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    case 'getAllUsers':
        $listUsers = $userController->getAllUsers();
        foreach ($listUsers as $user) {
            $response[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'role' => $user->getRole(),
                'created_at' => $user->getCreatedAt(),
                'is_block' => $user->isBlocked(),
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    case 'blockUser':
        $userId = $_POST['id'];
        $response = $userController->blockUser($userId);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $response,
            'message' => $response ? 'User blocked successfully' : 'Failed to block user',
        ]);
        break;
    case 'unblockUser':
        $userId = $_POST['id'];

        $response = $userController->unblockUser($userId);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $response,
            'message' => $response ? 'User unblocked successfully' : 'Failed to unblock user',
        ]);
        break;
    case 'getUserById':
        $userId = $_POST['id'];
        $user = $userController->getUserById($userId);
        if ($user) {
            $response = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'address' => $user->getAddress(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
                'created_at' => $user->getCreatedAt(),
                'is_block' => $user->isBlocked(),
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'User not found',
            ]);
        }
        break;
    case 'updateUser':
        $userId = $_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $userDto = new UserDto(
            $userId,
            $name,
            phone: $phone,
            address: $address,
        );

        $response = $userController->updateUserInformation($userDto);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $response,
            'message' => $response ? 'User updated successfully' : 'Failed to update user'
        ]);
        break;
    case 'search':
        if (isset($_GET['action']) && $_GET['action'] === 'search') {
            $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        
            // Fetch filtered users
            $users = $userController->searchUsers($query);
        
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'users' => $users
            ]);
            exit;
        }
        break;
    case 'filter':
        if (isset($_GET['action']) && $_GET['action'] === 'filter') {
            $query = isset($_GET['query']) ? trim($_GET['query']) : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 2;
            // Fetch filtered users
            $users = $userController->filterUsers($query, $page, $perPage);
            $totalUsers = $userController->getAllUsers();
            $totalUsersCount = count($totalUsers);
            $totalPages = ceil($totalUsersCount / $perPage);
        
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'users' => $users,
                'total_pages' => $totalPages,
            ]);
            exit;
        }
        break;
    case 'getUserStaticOrder':
        $data= $userController->getUserStatistics();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'users' => $data,
         
        ]);

    default:
        break;
}
?>