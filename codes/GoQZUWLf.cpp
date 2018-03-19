#include <iostream>

using namespace std;


string board[11][10];
int color[11][10];
string status[11][10];
int n_live, n_die1, n_die2;
string name, stat;
string die1_name[35], die2_name[35];
int x, y;
int n_hidden_die, player;
string hidden_name[35];

void enter(){

    for (int i=1; i<=10; i++)
        for (int j=1; j<=9; j++){
            board[i][j] = "none";
            color[i][j] = 2;
        }

    cin>>n_live;
    for (int i=1; i<=n_live; i++) {
        cin>>x>>y>>name>>stat;
        board[x][y] = name;
        status[x][y] = stat;
        color[x][y] = 0;
    }
    cin>>n_die1;
    for (int i=1; i<=n_die1; i++){
        cin>>die1_name[i];
    }

    cin>>n_live;
    for (int i=1; i<=n_live; i++) {
        cin>>x>>y>>name>>stat;
        board[x][y] = name;
        status[x][y] = stat;
        color[x][y] = 1;
    }
    cin>>n_die2;
    for (int i=1; i<=n_die2; i++){
        cin>>die2_name[i];
    }

    cin>>player;
    cin>>n_hidden_die;
    for (int i=1; i<=n_hidden_die; i++){
        cin>>hidden_name[i];
    }
}

void process(){
    for (int i=1; i<=10; i++){
        for (int j=1; j<=9; j++){
            if (color[i][j] == player){
                if (player == 0) {
                    cout<<i<<" "<<j<<" "<<i + 1<<" "<<j;
                    return ;
                }
                else{
                    cout<<i<<" "<<j<<" "<<i - 1<<" "<<j;
                    return ;
                }
            }
        }
    }
}

void print(){

}

int main(){
    enter();
    process();
    print();
    return 0;
}
