#!/bin/bash

# Mobile App API Test Suite
# Production Server: https://isp.mlbbshop.app

BASE_URL="https://isp.mlbbshop.app/api/v1"
TOKEN=""

echo "=========================================="
echo "MOBILE APP API TEST SUITE"
echo "=========================================="
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

test_endpoint() {
    local method=$1
    local endpoint=$2
    local data=$3
    local auth=$4
    local description=$5
    
    echo -e "${YELLOW}TEST:${NC} $description"
    echo "Method: $method | Endpoint: $endpoint"
    
    if [ "$method" = "POST" ] || [ "$method" = "PUT" ]; then
        if [ -z "$auth" ]; then
            curl -s -X $method "$BASE_URL$endpoint" \
                -H "Content-Type: application/json" \
                -H "Accept: application/json" \
                -d "$data" | python3 -m json.tool
        else
            curl -s -X $method "$BASE_URL$endpoint" \
                -H "Content-Type: application/json" \
                -H "Accept: application/json" \
                -H "Authorization: Bearer $TOKEN" \
                -d "$data" | python3 -m json.tool
        fi
    else
        if [ -z "$auth" ]; then
            curl -s -X $method "$BASE_URL$endpoint" \
                -H "Accept: application/json" | python3 -m json.tool
        else
            curl -s -X $method "$BASE_URL$endpoint" \
                -H "Accept: application/json" \
                -H "Authorization: Bearer $TOKEN" | python3 -m json.tool
        fi
    fi
    echo ""
}

# ==================== PUBLIC ENDPOINTS ====================
echo -e "${GREEN}=== PUBLIC ENDPOINTS (No Auth Required) ===${NC}"
echo ""

# 1. Register
test_endpoint "POST" "/register" \
    '{"name": "Mobile Test User", "phone": "09111222333", "password": "Test@2024", "confirm_password": "Test@2024"}' \
    "" \
    "User Registration"

# 2. Login (to get token)
echo -e "${YELLOW}Logging in to get token...${NC}"
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone": "09999888777", "password": "Test@123"}')

TOKEN=$(echo $LOGIN_RESPONSE | python3 -c "import sys, json; print(json.load(sys.stdin)['data']['token'])" 2>/dev/null)

if [ -z "$TOKEN" ]; then
    echo -e "${RED}Failed to get token!${NC}"
    echo $LOGIN_RESPONSE | python3 -m json.tool
    exit 1
fi

echo -e "${GREEN}Token obtained: ${TOKEN:0:20}...${NC}"
echo ""

# 3. Get Packages (Public)
test_endpoint "GET" "/packages" "" "" "Get All Packages"

# 4. Get Single Package (Public)
test_endpoint "GET" "/packages/1" "" "" "Get Package Details"

# 5. Get Banners (Public)
test_endpoint "GET" "/banners" "" "" "Get Banners/Sliders"

# 6. Get Settings (Public)
test_endpoint "GET" "/settings" "" "" "Get App Settings"

echo ""
echo -e "${GREEN}=== PROTECTED ENDPOINTS (Auth Required) ===${NC}"
echo ""

# 7. Get Profile
test_endpoint "GET" "/profile" "" "1" "Get User Profile"

# 8. Update Profile
test_endpoint "PUT" "/profile" '{"name": "Updated Name", "email": "test@example.com"}' "1" "Update User Profile"

# 9. Get Payments
test_endpoint "GET" "/payments" "" "1" "Get User Payments"

# 10. Get My Packages
test_endpoint "GET" "/my-packages" "" "1" "Get My Packages"

# 11. Get Bind Users (Broadband Accounts)
test_endpoint "GET" "/bind-users" "" "1" "Get Bind Users"

# 12. Get Fault Reports
test_endpoint "GET" "/fault-reports" "" "1" "Get Fault Reports"

# 13. Create Fault Report
test_endpoint "POST" "/fault-reports" \
    '{"title": "Internet Speed Issue", "description": "Getting very slow speeds since yesterday"}' \
    "1" \
    "Create Fault Report"

# 14. Get Notifications
test_endpoint "GET" "/notifications" "" "1" "Get Notifications"

# 15. Get Unread Count
test_endpoint "GET" "/notifications/unread-count" "" "1" "Get Unread Notification Count"

# 16. Get Payment Methods
test_endpoint "GET" "/payments/methods" "" "1" "Get Payment Methods"

# 17. Change Password
test_endpoint "POST" "/change-password" \
    '{"current_password": "Test@123", "new_password": "NewPass@2024", "confirm_password": "NewPass@2024"}' \
    "1" \
    "Change Password"

# 18. Refresh Token
test_endpoint "POST" "/refresh-token" "" "1" "Refresh Token"

# 19. Logout
test_endpoint "POST" "/logout" "" "1" "Logout"

# 20. Test with Revoked Token (should fail)
test_endpoint "GET" "/profile" "" "1" "Test Revoked Token (Should Fail)"

echo ""
echo -e "${GREEN}=========================================="
echo "TEST SUITE COMPLETED"
echo "==========================================${NC}"
