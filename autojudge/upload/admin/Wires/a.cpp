#include <iostream>
#include <cstring>
using namespace std;
 
int main()
{
    int t,j=1;
    cin>>t;
    while(j<=t){
    	int n;
    	cin>>n;
    	long long int dp[n+4][2];
    	memset(dp,0,sizeof dp);
    	long long int arr[n+4];
    	for(int i=0;i<n;i++){
    		cin>>arr[i];
    	}
    	dp[0][0] = 0;
    	dp[0][1] = arr[0];
    	dp[1][0] = arr[0];
    	dp[1][1] = arr[1];
    	for(int i=2;i<n;i++){
    		dp[i][0] = max(dp[i-1][0],dp[i-1][1]);
    		dp[i][1] = max(dp[i-2][1] + arr[i],dp[i-1][0] + arr[i]);
    	}
    	cout<<"Case "<<j<<": "<<max(dp[n-1][1],dp[n-1][0])<<endl;
    	j++;
    }
    return 0;
}