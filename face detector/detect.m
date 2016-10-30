run('C:\Users\micha\Documents\toolbox\vl_setup')
imageDir = 'test_images';
imageList = dir(sprintf('%s/*.jpg',imageDir));
nImages = length(imageList);
load('my_svm.mat');
%load('pos_neg_feats.mat');
bboxes = zeros(0,4);
bboxes75 = zeros(0,4);
bboxes50 = zeros(0,4);
bboxes25 = zeros(0,4);
%confidences = [pos_feats; neg_feats]*w + b;
confidences = zeros(0,1);
confidences75 = zeros(0,1);
confidences50 = zeros(0,1);
confidences25 = zeros(0,1);
image_names = cell(0,1);
current=1;
current75=1;
current50=1;
current25=1;
currentplot=1;
currentplot75=1;
currentplot50=1;
currentplot25=1;
cellSize = 6;
dim = 36;
i=4;
%for i=1:nImages
    % load and show the image
    %im = im2single(imread(sprintf('%s/%s',imageDir,imageList(i).name)));
    im = im2single(imread('class.jpg'));
    im75=imresize(im, 0.75);
    im50=imresize(im, 0.5);
    im25=imresize(im, 0.25);
    imshow(im);
    hold on;
    
    % generate a grid of features across the entire image. you may want to 
    % try generating features more densely (i.e., not in a grid)
    feats = vl_hog(im,cellSize);
    feats75 = vl_hog(im75,cellSize);
    feats50 = vl_hog(im50,cellSize);
    feats25 = vl_hog(im25,cellSize);
    
    % concatenate the features into 6x6 bins, and classify them (as if they
    % represent 36x36-pixel faces)
    %real img
    [rows,cols,~] = size(feats);    
    confs = zeros(rows,cols);
    for r=1:rows-5
        for c=1:cols-5
            featHere = feats(r:r+5,c:c+5,:);            
            confs(r,c) = featHere(:)'*w + b;
        end
    end
    %img75
    [rows,cols,~] = size(feats75);    
    confs75 = zeros(rows,cols);
    for r=1:rows-5
        for c=1:cols-5
            featHere75 = feats75(r:r+5,c:c+5,:);            
            confs75(r,c) = featHere75(:)'*w + b;
        end
    end
    %img50
    [rows,cols,~] = size(feats50);    
    confs50 = zeros(rows,cols);
    for r=1:rows-5
        for c=1:cols-5
            featHere50 = feats50(r:r+5,c:c+5,:);            
            confs50(r,c) = featHere50(:)'*w + b;
        end
    end
    %img25
    [rows,cols,~] = size(feats25);    
    confs25 = zeros(rows,cols);
    for r=1:rows-5
        for c=1:cols-5
            featHere25 = feats25(r:r+5,c:c+5,:);            
            confs25(r,c) = featHere25(:)'*w + b;
        end
    end
          
    % get the most confident predictions 
    [~,inds] = sort(confs(:),'descend');
    [~,inds75] = sort(confs75(:),'descend');
    [~,inds50] = sort(confs50(:),'descend');
    [~,inds25] = sort(confs25(:),'descend');
    %inds=[inds;inds75;inds50;inds25];
    %inds=sort(inds,'descend');
    inds = inds(1:20); % (use a bigger number for better recall)
    inds75 = inds75(1:20);
    inds50 = inds50(1:20);
    inds25 = inds25(1:5);
    for n=1:numel(inds)        
        [row,col] = ind2sub([size(feats,1) size(feats,2)],inds(n));
        
        bbox = [ (col)*(cellSize) ...
                 (row)*(cellSize) ...
                (col+cellSize-1)*(cellSize) ...
                (row+cellSize-1)*(cellSize)];
        conf = confs(row,col);
        image_name = {imageList(i).name};
        
        bboxes = [bboxes; bbox];
        confidences = [confidences; conf];
        image_names = [image_names; image_name];
    end
    
    for n=1:numel(inds50)        
        [row,col] = ind2sub([size(feats50,1) size(feats50,2)],inds50(n));
        
        bbox50 = [ ((col)*(cellSize))*2 ...
                 ((row)*(cellSize))*2 ...
                ((col+cellSize-1)*(cellSize))*2 ...
                ((row+cellSize-1)*(cellSize))*2];
        conf50 = confs50(row,col);

        
        bboxes50 = [bboxes50; bbox50];
        confidences50 = [confidences50; conf50];

    end
    %remove overlaps
    sizebox=size(bboxes, 1);
%    sizebox75=size(bboxes75, 1);
    sizebox50=size(bboxes50, 1);
%    sizebox25=size(bboxes25, 1);
    for c=current:size(bboxes, 1)
        bb=bboxes(c,:);
        %disp(current);
        for x=c+1:size(bboxes, 1)
            %disp(sizebox);
            bbgt=bboxes(x,:);
            bi=[max(bb(1),bbgt(1)) ; max(bb(2),bbgt(2)) ; min(bb(3),bbgt(3)) ; min(bb(4),bbgt(4))];
            iw=bi(3)-bi(1)+1;
            ih=bi(4)-bi(2)+1;
            if iw>0 && ih>0       
                % compute overlap as area of intersection / area of union
                ua=(bb(3)-bb(1)+1)*(bb(4)-bb(2)+1)+...
                (bbgt(3)-bbgt(1)+1)*(bbgt(4)-bbgt(2)+1)-...
                iw*ih;
                ov=(iw*ih)/ua;
                if ov>0.4 %higher overlap than the previous best?
                    if confidences(c,:)>confidences(x,:)
                        bboxes(x,:)=[0,0,0,0];
                        %sizebox=size(bboxes, 1);          
                        %disp(1);
                    else
                        bboxes(c,:)=[0,0,0,0];
                        %sizebox=size(bboxes, 1);
                        %disp(2);
                        break
                                              
                    end
      
                end
            end
        end
        if c==size(bboxes,1)
            current=c+1;
            break
        end
        current=c+1;
    end
    for c=current50:size(bboxes50, 1)
        bb50=bboxes50(c,:);
        %disp(current);
        for x=c+1:size(bboxes50, 1)
            %disp(sizebox);
            bbgt50=bboxes50(x,:);
            bi50=[max(bb50(1),bbgt50(1)) ; max(bb50(2),bbgt50(2)) ; min(bb50(3),bbgt50(3)) ; min(bb50(4),bbgt50(4))];
            iw50=bi50(3)-bi50(1)+1;
            ih50=bi50(4)-bi50(2)+1;
            if iw50>0 && ih50>0       
                % compute overlap as area of intersection / area of union
                ua50=(bb50(3)-bb50(1)+1)*(bb50(4)-bb50(2)+1)+...
                (bbgt50(3)-bbgt50(1)+1)*(bbgt50(4)-bbgt50(2)+1)-...
                iw50*ih50;
                ov50=(iw50*ih50)/ua50;
                if ov50>0.4 %higher overlap than the previous best?
                    if confidences50(c,:)>confidences50(x,:)
                        bboxes50(x,:)=[0,0,0,0];
                        %sizebox=size(bboxes, 1);          
                        %disp(1);
                    else
                        bboxes50(c,:)=[0,0,0,0];
                        %sizebox=size(bboxes, 1);
                        %disp(2);
                        break
                                              
                    end
      
                end
            end
        end
        if c==size(bboxes50,1)
            current50=c+1;
            break
        end
        current50=c+1;
    end
    for t=currentplot:size(bboxes, 1)
            plot_rectangle = [bboxes(t,1), bboxes(t,2); ...
            bboxes(t,1), bboxes(t,4); ...
            bboxes(t,3), bboxes(t,4); ...
            bboxes(t,3), bboxes(t,2); ...
            bboxes(t,1), bboxes(t,2)];
        plot(plot_rectangle(:,1), plot_rectangle(:,2), 'g-');
    end
    currentplot=t+1;
    for t=currentplot50:size(bboxes50, 1)
            plot_rectangle50 = [bboxes50(t,1), bboxes50(t,2); ...
            bboxes50(t,1), bboxes50(t,4); ...
            bboxes50(t,3), bboxes50(t,4); ...
            bboxes50(t,3), bboxes50(t,2); ...
            bboxes50(t,1), bboxes50(t,2)];
        plot(plot_rectangle50(:,1), plot_rectangle50(:,2), 'g-');
    end
    currentplot50=t+1;
    pause;
    %fprintf('got preds for image %d/%d\n', i,nImages);
%end

% evaluate
label_path = 'test_images_gt.txt';
[gt_ids, gt_bboxes, gt_isclaimed, tp, fp, duplicate_detections] = ...
    evaluate_detections_on_test(bboxes, confidences, image_names, label_path);
